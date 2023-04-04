<?php

namespace App\Repositories\Admin;

use App\Helpers\SessionKeyHelper;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Admin;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

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
        if ($admin && Hash::check($password , $admin->password) && $admin->status == 1) {

            // Generate session data
            $sessionData = [
                'user_uid' => $admin->admin_uid,
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

}
