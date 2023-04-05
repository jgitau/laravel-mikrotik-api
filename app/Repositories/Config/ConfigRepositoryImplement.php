<?php

namespace App\Repositories\Config;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Config;

class ConfigRepositoryImplement extends Eloquent implements ConfigRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Config $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
