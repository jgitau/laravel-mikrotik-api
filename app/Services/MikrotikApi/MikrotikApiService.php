<?php

namespace App\Services\MikrotikApi;

use LaravelEasyRepository\BaseService;

interface MikrotikApiService extends BaseService{

    /**
     * getMikrotikUserActive
     * @param  mixed $ip
     * @param  mixed $username
     * @param  mixed $password
     * @return void
     */
    public function getMikrotikUserActive($ip, $username, $password);
}
