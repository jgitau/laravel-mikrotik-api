<?php

namespace App\Repositories\Config;

use LaravelEasyRepository\Repository;

interface ConfigRepository extends Repository{

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
