<?php

namespace App\Http\Controllers\Backend\Setup\Administrator;

use App\Http\Controllers\Controller;
use App\Services\Group\GroupService;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    /**
     * Create a new controller instance.
     * Middleware 'checkPermissions' is applied here to ensure only authorized users can access certain methods.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checkPermissions:list_groups,add_new_group,edit_group')->only('index');
        $this->middleware('checkPermissions:add_new_group')->only('create');
        $this->middleware('checkPermissions:edit_group')->only('edit');
    }

    /**
     * Display the list of groups.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     * This method retrieves permissions from the request's attributes,
     * set by 'checkPermissions' middleware, and returns a view with these permissions.
     */
    public function index(Request $request)
    {
        // Retrieve the permissions from the request's attributes which were set in the 'checkPermissions' middleware
        $permissions = $request->attributes->get('permissions');
        // Return the view with the permissions.
        return view('backend.setup.administrators.group.list-groups', compact('permissions'));
    }

    /**
     * Show the form for creating a new group.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     * This method retrieves permissions from the request's attributes,
     * set by 'checkPermissions' middleware, and returns a view with these permissions.
     */
    public function create(Request $request)
    {
        // Retrieve the permissions from the request's attributes which were set in the 'checkPermissions' middleware
        $permissions = $request->attributes->get('permissions');
        // Return the view with the permissions.
        return view('backend.setup.administrators.group.add-new-group', compact('permissions'));
    }

    /**
     * Show the form for editing a group.
     * @param  \App\Services\Group\GroupService  $groupService
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     * This method retrieves permissions from the request's attributes,
     * set by 'checkPermissions' middleware, and returns a view with these permissions.
     */
    public function edit(GroupService $groupService, $id, Request $request)
    {
        // Retrieve the permissions from the request's attributes which were set in the 'checkPermissions' middleware
        $permissions = $request->attributes->get('permissions');
        // Get the group and its associated pages by ID
        $dataGroup = $groupService->getGroupAndPagesById($id);
        // Return the view with the permissions and dataGroup.
        return view('backend.setup.administrators.group.edit-group', compact('permissions', 'dataGroup'));
    }
}
