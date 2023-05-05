<?php

namespace App\Repositories\Config\UserData;

use LaravelEasyRepository\Repository;

interface UserDataRepository extends Repository{

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
