<?php

namespace App\Http\Controllers\Backend\Setup\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     * Middleware 'checkPermissions' is applied here to ensure only authorized users can access certain methods.
     * @return void
     */
    public function __construct()
    {
        // Apply the 'checkPermissions' middleware to this controller with 'vouchers_print_setup' as the required permission
        $this->middleware('checkPermissions:list_admins,add_new_admin,edit_admin,delete_admin')->only('index');
    }

    /**
     * Display the list of admins.
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
        return view('backend.setup.administrators.admin.list-admins', compact('permissions'));
    }
}
