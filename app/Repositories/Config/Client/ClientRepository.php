<?php

namespace App\Repositories\Config\Client;

use LaravelEasyRepository\Repository;

interface ClientRepository extends Repository{

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
