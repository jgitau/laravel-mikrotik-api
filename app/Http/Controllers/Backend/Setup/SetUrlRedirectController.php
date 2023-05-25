<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SetUrlRedirectController extends Controller
{
    public function index()
    {
        return view('backend.setup.set-url-redirect');
    }
}
