<?php

namespace App\Repositories\Setting;

use App\Helpers\AccessControlHelper;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Setting;

class SettingRepositoryImplement extends Eloquent implements SettingRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;
    protected $accessControlHelper;

    public function __construct(Setting $model, AccessControlHelper $accessControlHelper)
    {
        $this->model = $model;
        $this->accessControlHelper = $accessControlHelper;
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

    /**
     * Get the allowed permissions array for all actions.
     * @return array
     */
    public function getAllowedPermissions($actions)
    {
        // Prepare an empty array to hold the permissions for each action.
        $permissions = [];

        // Iterate over each action.
        foreach ($actions as $action) {
            // Add the permission for the action to the permissions array.
            $permissions[$this->getPermissionKey($action)] = $this->accessControlHelper->isAllowedToPerformAction($action);
        }

        return $permissions;
    }

    /**
     * Get the permission key for an action.
     * @param string $action
     * @return string
     */
    private function getPermissionKey($action)
    {
        // Split the action string by underscore.
        $splitAction = explode("_", $action);

        // Convert each word in the split action to capitalize the first letter.
        $studlyCaseAction = array_map('ucfirst', $splitAction);

        // Join the words back together without underscores and prepend 'isAllowedTo'.
        return 'isAllowedTo' . implode('', $studlyCaseAction);
    }
}
