<?php

namespace App\Http\Controllers\Backend\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListServiceController extends Controller
{
    /**
     * Create a new controller instance.
     * Middleware 'checkPermissions' is applied here to ensure only authorized users can access certain methods.
     * @return void
     */
    public function __construct()
    {
        // Apply the 'checkPermissions' middleware to this controller with 'services' as the required permission
        $this->middleware('checkPermissions:list_services,add_new_service')->only('index');
        $this->middleware('checkPermissions:add_new_service')->only('create');
        $this->middleware('checkPermissions:edit_service')->only('edit');
    }

    /**
     * Display the list of services.
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
        return view('backend.services.list-services', compact('permissions'));
    }

    /**
     * Show the form for creating a new service.
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
        return view('backend.services.add-new-service', compact('permissions'));
    }

    /**
     * Show the form for editing a service.
     * @param  \App\Services\Service\ServiceService  $serviceService
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     * This method retrieves permissions from the request's attributes,
     * set by 'checkPermissions' middleware, and returns a view with these permissions.
     */
    // TODO:
    // public function edit(ServiceService $serviceService, $id, Request $request)
    // {
    //     // Retrieve the permissions from the request's attributes which were set in the 'checkPermissions' middleware
    //     $permissions = $request->attributes->get('permissions');
    //     // Get the service and its associated pages by ID
    //     $dataService = $serviceService->getServiceAndPagesById($id);
    //     // Return the view with the permissions and dataService.
    //     return view('backend.setup.administrators.service.edit-service', compact('permissions', 'dataService'));
    // }
}
