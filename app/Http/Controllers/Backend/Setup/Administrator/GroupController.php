<?php

namespace App\Http\Controllers\Backend\Setup\Administrator;

use App\Http\Controllers\Controller;
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

    public function create()
    {
        return view('backend.setup.administrators.group.add-new-group');
    }
}
