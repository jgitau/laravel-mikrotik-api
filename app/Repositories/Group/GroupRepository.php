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
    public function updateGroup($groupName, $permissions,$id);
}
