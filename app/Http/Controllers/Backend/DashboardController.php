<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class DashboardController extends Controller
{

    /**
     * index
     */
    public function index()
    {
        return view('backend.dashboard.index');
    }
}
