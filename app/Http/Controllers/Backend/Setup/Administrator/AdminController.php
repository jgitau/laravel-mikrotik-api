<?php

namespace App\Http\Controllers\Backend\Setup\Administrator;

use App\Http\Controllers\Controller;


class AdminController extends Controller
{
    /**
     * index
     */
    public function index()
    {
        return view('backend.setup.administrators.list-admins');
    }
}
