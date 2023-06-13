<?php

namespace App\Http\Controllers\Backend\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListClientController extends Controller
{
    public function index()
    {
        return view('backend.clients.list-clients');
    }
}
