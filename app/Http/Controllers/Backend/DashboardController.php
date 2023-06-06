<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Helpers\MikrotikConfigHelper;
use App\Services\Nas\NasService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class DashboardController extends Controller
{
    protected $nasService;

    public function __construct(NasService $nasService)
    {
        $this->nasService = $nasService;
    }

    /**
     * index
     */
    public function index()
    {
        return view('backend.dashboard.index');
    }


}
