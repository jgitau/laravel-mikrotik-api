<?php

namespace App\Repositories\ServiceMegalos;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\ServiceMegalos;

class ServiceMegalosRepositoryImplement extends Eloquent implements ServiceMegalosRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(ServiceMegalos $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
