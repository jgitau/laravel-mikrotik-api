<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /*
     * index
     */
    public function index()
    {
        return view('backend.services.list-services');
    }

}
