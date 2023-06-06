<?php

namespace App\Services\Nas;

use LaravelEasyRepository\Service;
use App\Repositories\Nas\NasRepository;
use Illuminate\Support\Facades\Log;

class NasServiceImplement extends Service implements NasService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(NasRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }


    /**
     * getNasByShortname
     *
     * @param  mixed $shortName
     * @return void
     */
    public function getNasByShortname($shortName)
    {
        try {
            return $this->mainRepository->getNasByShortname($shortName);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return [];
        }
    }

    /**
     * getNasParameters
     *
     * @param  mixed $shortName
     * @return void
     */
    public function getNasParameters()
    {
        try {
            return $this->mainRepository->getNasParameters();
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return [];
        }
    }

    /**
     * editNasProcess
     *
     * @param  mixed $shortName
     * @return void
     */
    public function editNasProcess($data)
    {
        try {
            return $this->mainRepository->editNasProcess($data);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return [];
        }
    }

    /**
     * getSetting
     *
     * @param  mixed $shortName
     * @return void
     */
    public function getSetting($settingName, $moduleId)
    {
        try {
            return $this->mainRepository->getSetting($settingName, $moduleId);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return [];
        }
    }

    /**
     * updateSetting
     *
     * @param  mixed $shortName
     * @return void
     */
    public function updateSetting($settingName, $moduleId, $value)
    {
        try {
            return $this->mainRepository->updateSetting($settingName, $moduleId, $value);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return [];
        }
    }

    /**
     * setupProcess
     *
     * @param  mixed $record
     * @param  mixed $data
     * @return void
     */
    public function setupProcess($record, $data)
    {
        try {
            return $this->mainRepository->setupProcess($record, $data);
        } catch (\Throwable $th) {
            return Log::debug($th->getMessage());
        }
    }

    /**
     * getMikrotikUserActive
     * @param  mixed $ip
     * @param  mixed $username
     * @param  mixed $password
     * @return void
     */
    public function getMikrotikUserActive($ip, $username, $password)
    {
        try {
            return $this->mainRepository->getMikrotikUserActive($ip, $username, $password);
        } catch (\Throwable $th) {
            return Log::debug($th->getMessage());
        }
    }
}
