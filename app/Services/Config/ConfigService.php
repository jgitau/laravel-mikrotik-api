<?php

namespace App\Services\Config;

use LaravelEasyRepository\BaseService;

interface ConfigService extends BaseService{

    /**
     * getDatatables
     */
    public function getDatatables();

    /**
     * getUrlRedirect
     */
    public function getUrlRedirect();

    /**
     * updateUrlRedirect
     * @param  mixed $request
     * @return void
     */
    public function updateUrlRedirect($request);
}
