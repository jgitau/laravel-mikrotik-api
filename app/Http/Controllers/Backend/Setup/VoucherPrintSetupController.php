<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Services\Setting\SettingService;
use Illuminate\Http\Request;

class VoucherPrintSetupController extends Controller
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
        $permissions = $this->settingService->getAllowedPermissions(['vouchers_print_setup']);
        return view('backend.setup.voucher-print-setup',compact('permissions'));
    }
}
