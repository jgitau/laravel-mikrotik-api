<?php

namespace App\Services\Config\UserData;

use LaravelEasyRepository\Service;
use App\Repositories\UserData\UserDataRepository;

class UserDataServiceImplement extends Service implements UserDataService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(UserDataRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
