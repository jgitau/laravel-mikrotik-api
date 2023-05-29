<?php

use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Report\UserController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\Setup\Administrator\AdminController;
use App\Http\Controllers\Backend\Setup\Config\ConfigController;
use App\Http\Controllers\Backend\Setup\Administrator\GroupController;
use App\Http\Controllers\Backend\Setup\SetUrlRedirectController;
use App\Http\Controllers\Backend\Setup\VoucherPrintSetupController;
use App\Http\Controllers\Home\LoginController;
use Illuminate\Support\Facades\Route;
// Get DataTatable
use App\Http\Livewire\Backend\Setup\Administrator\Admin\DataTable as DataTableAdmin;
use App\Http\Livewire\Backend\Setup\Administrator\Group\DataTable as DataTableGroup;
use App\Http\Livewire\Backend\Setup\Config\DataTable as DataTableConfig;
use App\Http\Livewire\Backend\Setup\Config\HotelRoom\DataTable as DataTableHotelRoom;

// Home / Login Page
Route::get('/', [LoginController::class, 'index'])->name('index');

// Dashboard
Route::middleware(['check.session.cookie'])->name('backend.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Clients Routes
    Route::get('clients/list-clients', [ClientController::class, 'index'])->name('clients.list-clients');

    // Services Routes
    Route::get('services/list-services', [ServiceController::class, 'index'])->name('services.list-services');

    // Reports Routes
    Route::get('reports/list-online-users', [UserController::class, 'index'])->name('reports.list-online-users');

    // Set URL Redirect Routes
    Route::get('setup/set-url-redirect', [SetUrlRedirectController::class, 'index'])->name('setup/set-url-redirect');
    Route::get('setup/voucher-print-setup', [VoucherPrintSetupController::class, 'index'])->name('setup/voucher-print-setup');
    // Administrator Group
    Route::prefix('setup/admin/')->name('setup.admin.')->group(function () {
        // List Admin Routes
        Route::get('list-admins', [AdminController::class, 'index'])->name('list-admins');
        // List Group Routes
        Route::get('list-groups', [GroupController::class, 'index'])->name('list-groups');
        // Add New Group Routes
        Route::get('add-new-group', [GroupController::class, 'create'])->name('add-new-group');
    });

    // Config Group
    Route::prefix('setup/config/')->name('setup.config.')->group(function () {
        // List Config Routes
        Route::get('list-configs', [ConfigController::class, 'index'])->name('list-config');
        Route::get('list-configs/hotel_rooms', [ConfigController::class, 'hotel_rooms'])->name('hotel_rooms');
    });

});
// Get DataTable List Admin
Route::get('livewire/backend/setup/administrator/admin/getDataTable', [DataTableAdmin::class, 'getDataTable'])->name('admin.getDataTable');
// Get DataTable List Group
Route::get('livewire/backend/setup/administrator/group/getDataTable', [DataTableGroup::class, 'getDataTable'])->name('group.getDataTable');
// Get DataTable Config Group
Route::get('livewire/backend/setup/config/getDataTable', [DataTableConfig::class, 'getDataTable'])->name('config.getDataTable');
// Get DataTable Hotel ROom Group
Route::get('livewire/backend/setup/config/hotelRoom/getDataTable', [DataTableHotelRoom::class, 'getDataTable'])->name('config.hotelRoom.getDataTable');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
