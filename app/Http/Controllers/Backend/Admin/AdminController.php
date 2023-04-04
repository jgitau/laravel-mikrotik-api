<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\Admin\AdminService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class AdminController extends Controller
{

    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->adminService->getDatatables($request);
        }
        return view('backend.setup.administrators.list-admins');
    }
}
