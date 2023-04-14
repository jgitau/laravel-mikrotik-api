<?php

namespace App\Services\Config\Router;

use LaravelEasyRepository\Service;
use App\Repositories\Config\Router\RouterRepository;

class RouterServiceImplement extends Service implements RouterService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(RouterRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
