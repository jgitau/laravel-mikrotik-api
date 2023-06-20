<?php

namespace App\Repositories\Nas;

use LaravelEasyRepository\Repository;

interface NasRepository extends Repository{

    /**
     * getNasByShortname
     * @param  mixed $shortname
     * @return void
     */
    public function getNasByShortname($shortName);

    /**
     * getNasParameters
     */
    public function getNasParameters();

    /**
     * editNasProcess
     * @param  mixed $data
     * @return void
     */
    public function editNasProcess($data);

    /**
     * getSetting
     * @param  mixed $settingName
     * @param  mixed $moduleId
     * @return void
     */
    public function getSetting($settingName, $moduleId);

    /**
     * updateSetting
     * @param  mixed $settingName
     * @param  mixed $moduleId
     * @param  mixed $value
     * @return void
     */
    public function updateSetting($settingName, $moduleId, $value);

    /**
     * setupProcess
     * @param  mixed $record
     * @param  mixed $data
     * @return void
     */
    public function setupProcess($record, $data);
}
