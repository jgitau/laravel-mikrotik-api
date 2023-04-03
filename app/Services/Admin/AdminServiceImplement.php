<?php

namespace App\Services\Admin;

use LaravelEasyRepository\Service;
use App\Repositories\Admin\AdminRepository;

class AdminServiceImplement extends Service implements AdminService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(AdminRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
