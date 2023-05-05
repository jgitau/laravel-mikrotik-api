<?php

namespace App\Services\Config\UserData;

use LaravelEasyRepository\Service;
use App\Repositories\Config\UserData\UserDataRepository;
use Illuminate\Support\Facades\Log;

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

    /**
     * getUserDataParameters
     */
    public function getUserDataParameters()
    {
        try {
            return $this->mainRepository->getUserDataParameters();
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
        }
    }

    /**
     * updateUserDataSettings
     *
     * @param  mixed $settings
     * @return void
     */
    public function updateUserDataSettings($settings)
    {
        try {
            return $this->mainRepository->updateUserDataSettings($settings);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
        }
    }
}
