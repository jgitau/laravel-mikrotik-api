<?php

namespace App\Services\Setting;

use LaravelEasyRepository\BaseService;

interface SettingService extends BaseService{

    /**
     * Retrieves a setting based on the setting name and module ID.
     * @param string $settingName The setting name.
     * @param string $moduleId The module id.
     * @return string Returns the setting value.
     */
    public function getSetting($settingName, $moduleId);

    /**
     * Updates a setting based on the setting name, module ID, and new value.
     * @param string $settingName The setting name.
     * @param string $moduleId The module id.
     * @param string $value The new value.
     * @return int The number of affected rows.
     */
    public function updateSetting($settingName, $moduleId, $value);

    /**
     * Get th allowede permissions array for all actions.
     * @return array
     * @param  mixed $actions
     */
    public function getAllowedPermissions($actions);
}
