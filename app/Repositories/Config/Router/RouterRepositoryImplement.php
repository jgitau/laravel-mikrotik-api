<?php

namespace App\Repositories\Config\Router;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Router;
use App\Models\RouterOsApi;

class RouterRepositoryImplement extends Eloquent implements RouterRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(RouterOsApi $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
