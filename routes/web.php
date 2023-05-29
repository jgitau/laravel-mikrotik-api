<?php

// Importing necessary classes with grouped namespace feature
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Backend\DashboardController,
    Backend\ClientController,
    Backend\ServiceController,
    Backend\Report\UserController,
    Backend\Setup\Administrator\AdminController,
    Backend\Setup\Administrator\GroupController,
    Backend\Setup\Config\ConfigController,
    Backend\Setup\SetUrlRedirectController,
    Backend\Setup\VoucherPrintSetupController,
    Home\LoginController
};

// Importing Livewire Controllers
use App\Http\Livewire\Backend\Setup\Administrator\{
    Admin\DataTable as DataTableAdmin,
    Group\DataTable as DataTableGroup
};
use App\Http\Livewire\Backend\Setup\Config\{
    DataTable as DataTableConfig,
    HotelRoom\DataTable as DataTableHotelRoom
};

// Home / Login Page route
Route::get('/', [LoginController::class, 'index'])->name('index');

// Grouping routes that require check.session.cookie middleware
Route::middleware(['check.session.cookie'])->group(function () {

    // Route for dashboard page
    Route::get('dashboard', [DashboardController::class, 'index'])->name('backend.dashboard');

    // Route for clients list page
    Route::get('clients/list-clients', [ClientController::class, 'index'])->name('backend.clients.list-clients');

    // Route for services list page
    Route::get('services/list-services', [ServiceController::class, 'index'])->name('backend.services.list-services');

    // Route for online users list page in reports section
    Route::get('reports/list-online-users', [UserController::class, 'index'])->name('backend.reports.list-online-users');

    // *** ROUTING FOR SETUP ***
    // Route for URL redirection and voucher print setup page, administrator and config setup
    Route::prefix('setup/')->name('backend.setup.')->group(function () {

        // Route for URL redirection setup page
        Route::get('set-url-redirect', [SetUrlRedirectController::class, 'index'])->name('set-url-redirect');

        // Route for voucher print setup page
        Route::get('voucher-print-setup', [VoucherPrintSetupController::class, 'index'])->name('voucher-print-setup');

        // Grouping routes related to administrator setup
        Route::prefix('admin/')->name('admin.')->group(function () {
            // Route for admins list page
            Route::get('list-admins', [AdminController::class, 'index'])->name('list-admins');
            // Route for groups list page
            Route::get('list-groups', [GroupController::class, 'index'])->name('list-groups');
            // Route for adding a new group
            Route::get('add-new-group', [GroupController::class, 'create'])->name('add-new-group');
        });

        // Grouping routes related to configuration setup
        Route::prefix('config/')->name('config.')->group(function () {
            // Route for configs list page
            Route::get('list-configs', [ConfigController::class, 'index'])->name('list-config');
            // Route for hotel rooms configuration page
            Route::get('list-configs/hotel_rooms', [ConfigController::class, 'hotel_rooms'])->name('hotel_rooms');
        });
    });

    // *** ROUTING FOR LIVEWIRE SETUP DATATABLE ***
    // Grouping routes related to getting datatable for both administrator and configurations
    Route::prefix('livewire/backend/setup')->group(function () {

        // Grouping routes related to getting datatable for administrator
        Route::prefix('administrator')->group(function () {
            // Route for getting datatable data for admins
            Route::get('admin/getDataTable', [DataTableAdmin::class, 'getDataTable'])->name('admin.getDataTable');
            // Route for getting datatable data for groups
            Route::get('group/getDataTable', [DataTableGroup::class, 'getDataTable'])->name('group.getDataTable');
        });

        // Grouping routes related to getting datatable for configurations
        Route::prefix('config')->group(function () {
            // Route for getting datatable data for configurations
            Route::get('getDataTable', [DataTableConfig::class, 'getDataTable'])->name('config.getDataTable');
            // Route for getting datatable data for hotel rooms configuration
            Route::get('hotelRoom/getDataTable', [DataTableHotelRoom::class, 'getDataTable'])->name('config.hotelRoom.getDataTable');
        });
    });
});

// Route for logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
