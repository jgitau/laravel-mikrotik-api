<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Backend\DashboardController,
    Backend\ServiceController,
    Backend\Report\UserController,
    Home\LoginController
};
use App\Http\Controllers\Backend\Client\ListClientController;
use App\Http\Livewire\Backend\Dashboard\DataTable as DataTableLeasesData;

// Home / Login Page route
Route::get('/', [LoginController::class, 'index'])->name('index');

// Grouping routes that require check.session.cookie middleware
Route::middleware(['check.session.cookie'])->group(function () {

    // Route for dashboard page
    Route::get('dashboard', [DashboardController::class, 'index'])->name('backend.dashboard');

    // Route for clients list page
    Route::get('clients/list-clients', [ListClientController::class, 'index'])->name('backend.clients.list-clients');

    // Route for services list page
    Route::get('services/list-services', [ServiceController::class, 'index'])->name('backend.services.list-services');

    // Route for online users list page in reports section
    Route::get('reports/list-online-users', [UserController::class, 'index'])->name('backend.reports.list-online-users');


    // Grouping routes related to getting datatable for both administrator and configurations
    Route::prefix('livewire/backend/dashboard')->group(function () {
        // Grouping routes related to getting datatable for administrator
        // Route for getting datatable data for admins
        Route::get('leasesData/getDataTable', [DataTableLeasesData::class, 'getDataTable'])->name('leasesData.getDataTable');
    });
});

// Route for logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
