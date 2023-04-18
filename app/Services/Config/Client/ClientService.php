<?php

namespace App\Services\Config\Client;

use LaravelEasyRepository\BaseService;

interface ClientService extends BaseService{

    /**
     * getClientParameters
     *
     * @return void
     */
    public function getClientParameters();


    /**
     * updateClientSettings
     *
     * @param  mixed $settings
     * @return void
     */
    public function updateClientSettings($settings);
}
