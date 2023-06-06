<?php

namespace App\Repositories\MikrotikApi;

use LaravelEasyRepository\Repository;

interface MikrotikApiRepository extends Repository{

    /**
     * getMikrotikUserActive
     * @param  mixed $ip
     * @param  mixed $username
     * @param  mixed $password
     * @return void
     */
    public function getMikrotikUserActive($ip, $username, $password);
}
