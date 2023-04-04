<?php

use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Setup\ConfigController;
use App\Http\Controllers\Home\LoginController;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home/Login Page
Route::get('/', [LoginController::class, 'index'])->name('index');

// Dashboard
Route::middleware(['check.session.cookie'])->name('backend.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Clients Routes
    Route::get('clients/list-clients', [ClientController::class, 'index'])->name('clients.list-clients');

    // Setup Routes
    Route::get('setup/config/list-configs', [ConfigController::class, 'index'])->name('setup.config.list-configs');
    Route::get('setup/admin/list-admins', [AdminController::class, 'index'])->name('setup.admin.list-admins');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
