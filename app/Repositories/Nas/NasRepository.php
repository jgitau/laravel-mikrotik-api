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
     * setupProcess
     * @param  mixed $record
     * @param  mixed $data
     * @return void
     */
    public function setupProcess($record, $data);
}
