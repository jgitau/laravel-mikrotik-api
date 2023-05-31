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

    /**
     * storeNewGroup
     * @param  mixed $groupName
     * @param  mixed $permissions
     */
    public function storeNewGroup($groupName, $permissions);
}
