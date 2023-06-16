<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Services\Setting\SettingService;
use Illuminate\Http\Request;

class SetUrlRedirectController extends Controller
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

    public function index()
    {
        // Check if the user is allowed to get permissions
        $permissions = $this->settingService->getAllowedPermissions(['set_url_redirect']);
        return view('backend.setup.set-url-redirect', compact('permissions'));
    }
}
