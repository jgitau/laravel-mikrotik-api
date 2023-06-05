<?php

namespace App\Http\Controllers\Backend\Setup\Administrator;

use App\Helpers\AccessControlHelper;
use App\Http\Controllers\Controller;


class AdminController extends Controller
{
    /*
     * index
     */
    public function index()
    {
        $isAllowedToAddAdmin = AccessControlHelper::isAllowedToPerformAction('add_new_admin');
        return view('backend.setup.administrators.admin.list-admins', ['isAllowedToAddAdmin' => $isAllowedToAddAdmin]);
    }

}
