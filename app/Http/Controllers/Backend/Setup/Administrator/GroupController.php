<?php

namespace App\Http\Controllers\Backend\Setup\Administrator;

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
        return view('backend.setup.administrators.group.list-groups');
    }

    /**
     * create
     */
    public function create()
    {
        return view('backend.setup.administrators.group.add-new-group');
    }


    /**
     * The "edit" function in PHP takes a parameter "id".
     * @param id
     */
    public function edit(GroupService $groupService, $id)
    {
        $dataGroup = $groupService->getGroupAndPagesById($id);
        return view('backend.setup.administrators.group.edit-group', ['dataGroup' => $dataGroup]);
    }
}
