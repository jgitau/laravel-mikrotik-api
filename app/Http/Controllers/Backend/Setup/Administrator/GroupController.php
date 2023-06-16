<?php

namespace App\Http\Controllers\Backend\Setup\Administrator;

use App\Helpers\AccessControlHelper;
use App\Http\Controllers\Controller;
use App\Services\Group\GroupService;
use App\Services\Setting\SettingService;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    public $settingService;
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * index
     */
    public function index()
    {
        // Check if the user is allowed to get permissions
        $permissions = $this->settingService->getAllowedPermissions([
            'list_groups',
            'add_new_group',
            'edit_group'
        ]);

        return view('backend.setup.administrators.group.list-groups', compact('permissions'));
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
