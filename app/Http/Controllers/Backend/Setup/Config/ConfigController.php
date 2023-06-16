<?php

namespace App\Http\Controllers\Backend\Setup\Config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * Create a new controller instance.
     * Middleware 'checkPermissions' is applied here to ensure only authorized users can access certain methods.
     * @return void
     */
    public function __construct()
    {
        // Apply the 'checkPermissions' middleware to this controller with 'vouchers_print_setup' as the required permission
        $this->middleware('checkPermissions:list_config')->only('index');
        $this->middleware('checkPermissions:config_hotel_rooms')->only('hotel_rooms');
    }

    /**
     * Handle the incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     * This method retrieves permissions from the request's attributes,
     * set by 'checkPermissions' middleware, and returns a view with these permissions.
     */
    public function index(Request $request)
    {
        // Retrieve the permissions from the request's attributes which were set in the 'checkPermissions' middleware
        $permissions = $request->attributes->get('permissions');
        // Get the permissions array and return the view.
        return view('backend.setup.configs.index', compact('permissions'));
    }

    /**
     * Handle the incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     * This method retrieves permissions from the request's attributes,
     * set by 'checkPermissions' middleware, and returns a view with these permissions.
     */
    public function hotel_rooms(Request $request)
    {
        // Retrieve the permissions from the request's attributes which were set in the 'checkPermissions' middleware
        $permissions = $request->attributes->get('permissions');
        // Get the permissions array and return the view.
        return view('backend.setup.configs.hotel_rooms', compact('permissions'));
    }
}
