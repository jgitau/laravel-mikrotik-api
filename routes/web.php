<?php

use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Setup\Administrator\AdminController;
use App\Http\Controllers\Backend\Setup\Config\ConfigController;
use App\Http\Controllers\Backend\Setup\Administrator\GroupController;
use App\Http\Controllers\Home\LoginController;
use App\Http\Livewire\Backend\Setup\Administrator\Admin\DataTable as DataTableAdmin;
use App\Http\Livewire\Backend\Setup\Administrator\Group\DataTable as DataTableGroup;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

// Home/Login Page
Route::get('/', [LoginController::class, 'index'])->name('index');

// Dashboard
Route::middleware(['check.session.cookie'])->name('backend.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Clients Routes
    Route::get('clients/list-clients', [ClientController::class, 'index'])->name('clients.list-clients');

    // Setup Routes

    // Config Routes
    Route::get('setup/config/list-configs', [ConfigController::class, 'index'])->name('setup.config.list-configs');
    // Admin Routes
    Route::get('setup/admin/list-admins', [AdminController::class, 'index'])->name('setup.admin.list-admins');
    // Group Routes
    Route::get('setup/admin/list-groups', [GroupController::class, 'index'])->name('setup.admin.list-groups');

});
// Get DataTable Admin
Route::get('livewire/backend/setup/administrator/admin/getDataTable', [DataTableAdmin::class, 'getDataTable'])->name('admin.getDataTable');
Route::get('livewire/backend/setup/administrator/group/getDataTable', [DataTableGroup::class, 'getDataTable'])->name('group.getDataTable');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
