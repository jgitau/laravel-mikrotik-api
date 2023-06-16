<?php

namespace App\Repositories\Setting;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Setting;

class SettingRepositoryImplement extends Eloquent implements SettingRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieves a setting based on the setting name and module ID.
     * @param string $settingName The setting name.
     * @param string $moduleId The module id.
     * @return string Returns the setting value.
     */
    public function getSetting($settingName, $moduleId)
    {
        // Retrieves the setting value based on setting name and module id.
        $query = $this->model->where('module_id', $moduleId)->where('setting', $settingName)->first();
        return $query->value ?? "";
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
        // Updates the setting value in the database and returns the number of affected rows.
        return $this->model->where('module_id', $moduleId)->where('setting', $settingName)->update(['value' => $value]);
    }
}
