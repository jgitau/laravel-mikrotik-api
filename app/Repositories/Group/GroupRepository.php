<?php

namespace App\Repositories\Group;

use LaravelEasyRepository\Repository;

interface GroupRepository extends Repository{

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
