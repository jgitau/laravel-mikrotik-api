<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Backend\Setup\Administrator\AdminController,
    Backend\Setup\Administrator\GroupController,
    Backend\Setup\Config\ConfigController,
    Backend\Setup\SetUrlRedirectController,
    Backend\Setup\VoucherPrintSetupController
};
// Import Livewire Controllers
use App\Http\Livewire\Backend\Setup\Administrator\{
    Admin\DataTable as DataTableAdmin,
    Group\DataTable as DataTableGroup
};
use App\Http\Livewire\Backend\Setup\Config\{
    DataTable as DataTableConfig,
    HotelRoom\DataTable as DataTableHotelRoom
};

Route::middleware(['check.session.cookie'])->group(function () {
    Route::prefix('setup')->name('backend.setup.')->group(function () {
        // Route for URL redirection setup page
        Route::get('set-url-redirect', [SetUrlRedirectController::class, 'index'])->name('set-url-redirect');

        // Route for voucher print setup page
        Route::get('voucher-print-setup', [VoucherPrintSetupController::class, 'index'])->name('voucher-print-setup');

        // Grouping routes related to administrator setup
        Route::prefix('admin')->name('admin.')->group(function () {
            // Route for admins list page
            Route::get('list-admins', [AdminController::class, 'index'])->name('list-admins');
            // Route for groups list page
            Route::get('list-groups', [GroupController::class, 'index'])->name('list-groups');
            // Route for adding a new group
            Route::get('add-new-group', [GroupController::class, 'create'])->name('add-new-group');
        });

        // Grouping routes related to configuration setup
        Route::prefix('config')->name('config.')->group(function () {
            // Route for configs list page
            Route::get('list-configs', [ConfigController::class, 'index'])->name('list-config');
            // Route for hotel rooms configuration page
            Route::get('list-configs/hotel_rooms', [ConfigController::class, 'hotel_rooms'])->name('hotel_rooms');
        });
    });

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
