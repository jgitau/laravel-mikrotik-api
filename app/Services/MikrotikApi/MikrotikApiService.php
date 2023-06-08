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

    /**
     * getMikrotikActiveHotspot
     * @param  mixed $ip
     * @param  mixed $username
     * @param  mixed $password
     * @return void
     */
    public function getMikrotikActiveHotspot($ip, $username, $password);

    /**
     * getMikrotikResourceData
     * @param  mixed $ip
     * @param  mixed $username
     * @param  mixed $password
     * @return void
     */
    public function getMikrotikResourceData($ip, $username, $password);

    /**
     * getTrafficData
     * @param  mixed $ip
     * @param  mixed $username
     * @param  mixed $password
     * @param  mixed $interface
     * @return void
     */
    public function getTrafficData($ip, $username, $password, $interface);

    /**
     * connect
     * @param  mixed $ip
     * @param  mixed $username
     * @param  mixed $password
     * @return void
     */
    public function connect($ip, $username, $password);

}
