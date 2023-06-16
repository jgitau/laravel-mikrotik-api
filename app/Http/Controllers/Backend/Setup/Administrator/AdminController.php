<?php

namespace App\Http\Controllers\Backend\Setup\Administrator;

use App\Helpers\AccessControlHelper;
use App\Http\Controllers\Controller;
use App\Services\Setting\SettingService;

class AdminController extends Controller
{

    public $settingService;
    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * Display the list of admins.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $permissions = $this->settingService->getAllowedPermissions([
            'list_admins',
            'add_new_admin',
            'edit_admin',
            'delete_admin'
        ]);
        // Get the permissions array and return the view.
        return view('backend.setup.administrators.admin.list-admins', compact('permissions'));
    }
}
