<?php

namespace App\Repositories\Config;

use LaravelEasyRepository\Repository;

interface ConfigRepository extends Repository{


    /**
     * getDatatables
     */
    public function getDatatables();
}
