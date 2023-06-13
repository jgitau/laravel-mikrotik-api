<?php

namespace App\Repositories\Admin;

use App\Helpers\AccessControlHelper;
use App\Helpers\SessionKeyHelper;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Admin;
use App\Models\Page;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Yajra\DataTables\DataTables;

class AdminRepositoryImplement extends Eloquent implements AdminRepository
{
    use SessionKeyHelper;

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     */
    protected $model;

    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

    /**
     * validateAdmin
     * @param  mixed $username
     * @param  mixed $password
     */
    public function validateAdmin($username, $password)
    {
        // Get Admin!
        $admin = $this->model->where('username', strtolower($username))->first();

        // Check if admin data is found, password is correct, and admin status is active
        if ($admin && Hash::check($password, $admin->password) && $admin->status == 1) {

            // Generate session data
            $sessionData = [
                'user_uid' => $admin->admin_uid,
                'group_id' => $admin->group_id,
                'role' => $admin->group->name,
                'login_status' => 'Active',
                'fullname' => $admin->fullname,
                'username' => $admin->username
            ];

            // Generate session key and Redis key prefix
            $sessionKey = str()->random();
            $redisKey = '_redis_key_prefix_' . $sessionKey;

            // Save session data to Redis with the generated key and set expiration time
            Redis::hMSet($redisKey, $sessionData);
            Redis::expire($redisKey, 7200);

            // Create a new cookie with session key and set expiration time
            $cookie = Cookie::make('session_key', $sessionKey, 120); // 120 minutes

            // Queue the cookie to be sent with the next response
            Cookie::queue($cookie);

            // Save login log
            $this->saveLoginLog($username);

            // Return session key, session data, and cookie for further use
            return [
                'session_key' => $sessionKey,
                'session_data' => $sessionData,
                'cookie' => $cookie
            ];
        }

        // Return false if the login credentials are not valid
        return false;
    }


    /**
     * saveLoginLog
     * @param  mixed $username
     * @return void
     */
    private function saveLoginLog($username)
    {
        // Create key login log for daily, monthly, and total login
        $logKeys = ['daily_login', 'monthly_login', 'total_login'];
        $privateRedisLog = "mglanalytic|";

        // Loop through each log key to process daily, monthly, and total login logs
        foreach ($logKeys as $logKey) {
            $setDate = '';

            // If the log key is for daily login, set the date format as YYYY-MM-DD
            if ($logKey == 'daily_login') {
                $setDate = date('|Y-m-d', time());
            }

            // If the log key is for monthly login, set the date format as YYYY-MM
            if ($logKey == 'monthly_login') {
                $setDate = date('|Y-m', time());
            }

            // Combine the private Redis log key, log key, username, and date to create a unique Redis log entry
            $redisLog = $privateRedisLog . $logKey . '|' . $username . $setDate;
            // Prepare the data to be stored in the log entry
            $data = [
                'username' => $username,
                'time' => time()
            ];

            // Create a Redis key for incrementing the count of log entries
            $redisInc = $redisLog . '|count';
            // Increment the count of log entries by 1
            Redis::incrBy($redisInc, 1);
            // Add the log entry data to a sorted set in Redis with a score of 1
            Redis::zAdd($redisLog, 1, json_encode($data));
        }
    }

    /**
     * logout
     */
    public function logout()
    {
        // get session key from cookie or queued cookies
        $sessionKey = Cookie::get('session_key') ?? $this->getQueuedSessionKey();
        $redisKey = '_redis_key_prefix_' . $sessionKey;

        // Delete data Redis
        if (Redis::exists($redisKey)) {
            Redis::del($redisKey);
        }

        // Delete existing cookies and create new cookies with expiration time in the past
        $cookie = Cookie::forget('session_key');

        // Redirect to the login page or home page
        return $cookie;
    }


    /**
     * Retrieves records from a database, initializes DataTables, adds columns to DataTable.
     * @return DataTables Yajra JSON response.
     */
    public function getDatatables()
    {
        // Retrieve records from the database using the model, including the related 'group' records, and sort by the latest records
        $data = $this->model->with('group')->latest()->get();

        // Initialize DataTables and add columns to the table
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                return $data->status == 1 ? '<span class="badge bg-label-success">Active</span>' : '<span class="badge bg-label-danger">Non Active</span>';
            })
            ->addColumn('action', function ($data) {
                $editButton = '';
                $deleteButton = '';

                // Check if the current group is allowed to edit
                if (AccessControlHelper::isAllowedToPerformAction('edit_admin')) {
                    // If group is allowed, show edit button
                    $editButton = '<button type="button" name="edit" class="edit btn btn-primary btn-sm" onclick="showAdmin(\'' . $data->admin_uid . '\')"> <i class="fas fa-edit"></i></button>';
                }

                // Check if the current group is allowed to delete
                if (AccessControlHelper::isAllowedToPerformAction('delete_admin')) {
                    // If group is allowed, show delete button
                    $deleteButton = '&nbsp;&nbsp;<button type="button" class="delete btn btn-danger btn-sm" onclick="confirmDeleteAdmin(\'' . $data->admin_uid . '\')"> <i class="fas fa-trash"></i></button>';
                }

                return $editButton . $deleteButton;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    /**
     * This function stores a new admin in the database with the provided information.
     * @param  mixed $request
     * @return void
     */
    public function storeNewAdmin($request)
    {
        try {
            // Create a new admin with the provided information
            $admin = $this->model->create([
                'group_id'    => $request['groupId'],
                'username'    => strtolower($request['username']),
                'password'    => Hash::make($request['password']),
                'status'      => $request['status'],
                'fullname'    => $request['fullName'],
                'email'       => $request['emailAddress'],
            ]);
            // Return the newly created admin
            return $admin;
        } catch (\Exception $e) {
            // Return null if there is an exception thrown during the creation process
            return null;
        }
    }


    /**
     * Updates an admin record in the database.
     * @param string $admin_uid The unique identifier of the admin.
     * @param Illuminate\Http\Request $request The request containing the updated admin data.
     * @return App\Models\Admin|null The updated admin or null if the admin was not found.
     * @throws InvalidArgumentException if admin_uid is not provided.
     * @throws RuntimeException if admin was not found.
     */
    public function updateAdmin($admin_uid, $request)
    {
        // Check if admin_uid is empty
        if (empty($admin_uid)) {
            // Throw an exception if admin_uid is empty
            throw new \InvalidArgumentException("admin_uid is empty");
        }

        // Retrieve the admin based on the given admin_uid
        $admin = $this->model->where('admin_uid', $admin_uid)->first();

        // Check if the admin was found
        if (!$admin) {
            // Throw an exception if admin was not found
            throw new \RuntimeException("Admin with uid {$admin_uid} not found");
        }

        // Prepare the admin data for update
        $adminData = [
            'username' => strtolower($request['username']),
            'fullname' => $request['fullname'],
            'email' => $request['email'],
            'group_id' => $request['group_id'],
            'status' => $request['status'],
        ];

        // Check if password is provided in the request
        if (!empty($request->password)) {
            // If so, hash the password and add it to the admin data
            $adminData['password'] = Hash::make($request->password);
        }

        // Update the admin with the prepared data
        $admin->update($adminData);

        // Return the updated admin
        return $admin;
    }

    /**
     * This PHP function deletes an admin user by their unique identifier.
     * @param  mixed $admin_uid
     * @return void
     */
    public function deleteAdmin($admin_uid)
    {
        // Find the admin by uid
        $admin = $this->model->where('admin_uid', $admin_uid)->first();
        if ($admin) {
            // Delete the admin
            $admin->delete();
            // Return a success message
            return true;
        }
        // Return a failure message
        return null;
    }



    /**
    * This PHP function retrieves an admin user by their unique identifier.
     * @param  mixed $uid
     * @return void
     */
    public function getAdminByUid($uid)
    {
        $admin = $this->model->with('group')->where('admin_uid', $uid)->first();
        return $admin;
    }

}
