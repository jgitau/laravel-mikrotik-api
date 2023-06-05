<?php

namespace App\Http\Controllers\Backend\Setup\Administrator;

use App\Helpers\AccessControlHelper;
use App\Http\Controllers\Controller;
use App\Services\Group\GroupService;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * index
     */
    public function index()
    {
        // Check if the user is allowed to add a new group
        $isAllowedToAddGroup = AccessControlHelper::isAllowedToPerformAction('add_new_group');

        // Check if the user is allowed to list groups
        $isAllowedToListGroup = AccessControlHelper::isAllowedToPerformAction('list_groups');

        return view('backend.setup.administrators.group.list-groups', [
            'isAllowedToAddGroup' => $isAllowedToAddGroup,
            'isAllowedToListGroup' => $isAllowedToListGroup
        ]);
    }

    /**
     * create
     */
    public function create()
    {
        // Check if the user is allowed to add a new group
        $isAllowedToAddGroup = AccessControlHelper::isAllowedToPerformAction('add_new_group');

        return view('backend.setup.administrators.group.add-new-group', [
            'isAllowedToAddGroup' => $isAllowedToAddGroup,
        ]);
    }

    /**
     * The "edit" function in PHP takes a parameter "id".
     * @param id
     */
    public function edit(GroupService $groupService, $id)
    {
        // Check if the user is allowed to edit a group
        $isAllowedToEditGroup = AccessControlHelper::isAllowedToPerformAction('edit_group');

        // Get the group and its associated pages by ID
        $dataGroup = $groupService->getGroupAndPagesById($id);

        return view('backend.setup.administrators.group.edit-group', [
            'dataGroup' => $dataGroup,
            'isAllowedToEditGroup' => $isAllowedToEditGroup
        ]);
    }
}
