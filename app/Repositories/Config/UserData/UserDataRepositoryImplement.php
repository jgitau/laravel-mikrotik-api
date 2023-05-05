<?php

namespace App\Repositories\Config\UserData;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Setting;

class UserDataRepositoryImplement extends Eloquent implements UserDataRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
