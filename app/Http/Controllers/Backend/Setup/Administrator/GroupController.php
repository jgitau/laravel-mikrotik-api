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
        return view('backend.setup.administrators.list-groups');
    }
}
