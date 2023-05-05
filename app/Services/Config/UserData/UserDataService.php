<?php

namespace App\Services\Config\UserData;

use LaravelEasyRepository\BaseService;

interface UserDataService extends BaseService{

    /**
     * getUserDataParameters
     *
     * @return void
     */
    public function getUserDataParameters();

    /**
     * updateUserDataSettings
     *
     * @param  mixed $settings
     * @return void
     */
    public function updateUserDataSettings($settings);
}
