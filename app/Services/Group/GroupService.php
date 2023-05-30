<?php

namespace App\Services\Group;

use LaravelEasyRepository\BaseService;

interface GroupService extends BaseService{

    /**
     * getDatatables
     */
    public function getDatatables();

    /**
     * getDataPermissions
     */
    public function getDataPermissions();
}
