<?php

namespace App\Repositories\Client;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Client;

class ClientRepositoryImplement extends Eloquent implements ClientRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Client $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
