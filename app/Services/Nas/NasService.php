<?php

namespace App\Services\Nas;

use LaravelEasyRepository\BaseService;

interface NasService extends BaseService{

    /**
     * getNasByShortname
     * @param  mixed $shortname
     * @return void
     */
    public function getNasByShortname($shortName);

    /**
     * getNasParameters
     *
     * @return void
     */
    public function getNasParameters();

    /**
     * editNasProcess
     * @param  mixed $data
     * @return void
     */
    public function editNasProcess($data);

    /**
     * setupProcess
     * @param  mixed $record
     * @param  mixed $data
     * @return void
     */
    public function setupProcess($record, $data);
}
