<?php

namespace App\Http\Controllers\Backend\Setup\Ads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        // Apply the 'checkPermissions' middleware to this controller with 'vouchers_print_setup' as the required permission
        $this->middleware('checkPermissions:list_ads,add_ad,edit_ad,delete_ad');
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
        return view('backend.setup.ads.list-ads', compact('permissions'));
    }
}
