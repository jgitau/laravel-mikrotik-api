<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Backend\Service\ListServiceController,
};

// Grouping routes that require check.session.cookie middleware
Route::middleware(['check.session.cookie'])->group(function () {

    // Grouping routes related to SETUP section
    Route::prefix('services')->name('backend.services.')->group(function () {
        // Route for services list page
        Route::get('list-services', [ListServiceController::class, 'index'])->name('list-services');
        // Route for add new service page
        Route::get('add-new-service', [ListServiceController::class, 'create'])->name('add-new-service');
    });
});
