<?php

namespace App\Services\Config;

use LaravelEasyRepository\BaseService;

interface ConfigService extends BaseService{

    /**
     * getDatatables
     */
    public function getDatatables();
}