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
     * getGroupAndPagesById
     * @param  mixed $id
     */
    public function getGroupAndPagesById($id);

    /**
     * storeNewGroup
     * @param  mixed $groupName
     * @param  mixed $permissions
     */
    public function storeNewGroup($groupName, $permissions);

    /**
     * updateGroup
     * @param  mixed $groupName
     * @param  mixed $permissions
     * @param  mixed $id
     */
    public function updateGroup($groupName, $permissions, $id);
}
