<?php

namespace App\Http\Controllers\Backend\Setup\Config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * The function returns a view for the index page of a backend setup configuration.
     *
     * @return View called "backend.setup.configs.index" is being returned.
     */
    public function index()
    {
        return view('backend.setup.configs.index');
    }

    public function hotel_rooms()
    {
        return view('backend.setup.configs.hotel_rooms');
    }
}
