<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\RouterOsApi;
use Illuminate\Http\Request;

class LoginController extends Controller
{
  public function index()
  {
    // $host = env('ROUTER_IP');
    // $user = env('ROUTER_USER');
    // $pass = env('ROUTER_PASS');
    // $API = new RouterOsApi();
    // $API->debug = false;
    // if ($API->connect($host, $user, $pass)) {
    //   // *** TODO: **
    //   $identity = $API->comm('/system/identity/print');
    //   $routerModel = $API->comm('/system/routerboard/print');
    //   // $response = $API->comm('/ip/hotspot/user/print');

    //   $API->write('/ip/address/print');
    //   $READ = $API->read(false);
    //   $ARRAY = $API->parseResponse($READ);
    //   dd($ARRAY);
    // } else {
    //   dd('Gagal');
    // }
    $pageConfigs = ['myLayout' => 'blank'];
    return view('home.login.index', ['pageConfigs' => $pageConfigs]);
  }
}
