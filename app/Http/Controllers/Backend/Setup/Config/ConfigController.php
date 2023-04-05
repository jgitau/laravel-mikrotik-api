<?php

namespace App\Http\Controllers\Backend\Setup\Config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        return view('backend.setup.configs.index');
    }
}
