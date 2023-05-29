<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VoucherPrintSetupController extends Controller
{
    public function index()
    {
        return view('backend.setup.voucher-print-setup');
    }
}
