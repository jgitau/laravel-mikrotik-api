<?php

namespace App\Repositories\Admin;

use App\Helpers\SessionKeyHelper;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Admin;
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
        $admin = $this->model->where('username', $username)->first();

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
     * getDatatables
     */
    public function getDatatables()
    {
        // Retrieve records from the database using the model, including the related 'group' records, and sort by the latest records
        $data = $this->model->with('group')->latest()->get();

        // Initialize the DataTables library using the fetched data
        $dataTables = DataTables::of($data)
            // Add an index column to the DataTable for easier reference
            ->addIndexColumn()
            // Add a new 'status' column to the DataTable, displaying 'Active' if status is 1, and 'Non Active' otherwise
            ->addColumn('status', function ($data) {
                return $data->status == 1 ? 'Active' : 'Non Active';
            })
            // Add a new 'action' column to the DataTable, including edit and delete buttons with their respective icons
            ->addColumn('action', function ($data) {
                // Create an edit button with the record's 'admin_uid' as its ID and a 'fas fa-edit' icon
                $button = '<button type="button" name="edit" class="edit btn btn-primary btn-sm" onclick="showAdmin(\'' . $data->admin_uid . '\')"> <i class="fas fa-edit"></i></button>';
                // Add a delete button with the record's 'admin_uid' as its ID and a 'fas fa-trash' icon
                $button .= '&nbsp;&nbsp;<button type="button" name="edit" id="' . $data->admin_uid . '" class="delete btn btn-danger btn-sm"> <i class="fas fa-trash"></i></button>';
                // Return the concatenated button HTML string
                return $button;
            })
            // Create and return the DataTables response as a JSON object
            ->make(true);

        // Return the DataTables JSON response
        return $dataTables;
    }


    /**
     * This function stores a new admin in the database with the provided information.
     *
     * @param request  is a parameter that is passed to the function storeNewAdmin(). It is
     * likely an associative array that contains the data needed to create a new admin user. The keys
     * in the array are likely the names of the fields in a form that was submitted, and the values are
     * the data entered by the
     *
     * @return instance of the newly created admin if the creation is successful, and null if there
     * is an exception thrown during the creation process.
     */
    public function storeNewAdmin($request)
    {
        try {
            // Create a new admin with the provided information
            $admin = $this->model->create([
                'group_id'    => $request['groupId'],
                'username'    => $request['username'],
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
    * This PHP function retrieves an admin user by their unique identifier.
    * @return The function `getAdminByUid` returns the first row of the `model` table where the
    * `admin_uid` column matches the `` parameter. It returns an object representing the row, or
    * `null` if no matching row is found.
    */
    public function getAdminByUid($uid)
    {
        $admin = $this->model->with('group')->where('admin_uid', $uid)->first();
        return $admin;
    }

}
