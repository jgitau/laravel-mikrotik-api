<?php

namespace App\Repositories\Admin;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class AdminRepositoryImplement extends Eloquent implements AdminRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
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
        $admin = $this->model->where('username', $username)->first();
        if ($admin && Hash::check($password , $admin->password) && $admin->status == 1) {
            $sessionData = [
                'user_uid' => $admin->admin_uid,
                'group_id' => $admin->group_id,
                'login_status' => 'Active',
                'fullname' => $admin->fullname,
                'username' => $admin->username
            ];

            $sessionKey = str()->random();
            $redisKey = '_redis_key_prefix_' . $sessionKey;

            // *** TODO: REDIS ***
            Redis::hMSet($redisKey, $sessionData);
            Redis::expire($redisKey, 7200);
            // Logika login log di sini

            return [
                'session_key' => $sessionKey,
                'session_data' => $sessionData,
            ];
        }

        return false;
    }
}
