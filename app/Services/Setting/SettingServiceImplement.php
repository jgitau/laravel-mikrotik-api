<?php

namespace App\Services\Setting;

use LaravelEasyRepository\Service;
use App\Repositories\Setting\SettingRepository;
use Exception;

class SettingServiceImplement extends Service implements SettingService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(SettingRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    /**
     * Retrieves a setting based on the setting name and module ID.
     * @param string $settingName The setting name.
     * @param string $moduleId The module id.
     * @return string Returns the setting value.
     */
    public function getSetting($settingName, $moduleId)
    {
        try {
            return $this->mainRepository->getSetting($settingName, $moduleId);
        } catch (Exception $exception) {
            throw new Exception("Error getting data setting : " . $exception->getMessage());
        }
    }

    /**
     * Updates a setting based on the setting name, module ID, and new value.
     * @param string $settingName The setting name.
     * @param string $moduleId The module id.
     * @param string $value The new value.
     * @return int The number of affected rows.
     */
    public function updateSetting($settingName, $moduleId, $value)
    {
        try {
            return $this->mainRepository->updateSetting($settingName, $moduleId, $value);
        } catch (Exception $exception) {
            throw new Exception("Error updated setting : " . $exception->getMessage());
        }
    }
}
