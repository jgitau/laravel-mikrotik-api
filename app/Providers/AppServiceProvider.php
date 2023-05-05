<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

// Repositories
use App\Repositories\Config\Ads\AdsRepository;
use App\Repositories\Config\Ads\AdsRepositoryImplement;
use App\Repositories\Config\Client\ClientRepository;
use App\Repositories\Config\Client\ClientRepositoryImplement;
use App\Repositories\Config\HotelRoom\HotelRoomRepository;
use App\Repositories\Config\HotelRoom\HotelRoomRepositoryImplement;
use App\Repositories\Config\UserData\UserDataRepository;
use App\Repositories\Config\UserData\UserDataRepositoryImplement;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Instantiable Repositories in Sub-Folders
        $this->app->bind(
            ClientRepository::class,
            ClientRepositoryImplement::class
        );
        $this->app->bind(
            HotelRoomRepository::class,
            HotelRoomRepositoryImplement::class
        );
        $this->app->bind(
            AdsRepository::class,
            AdsRepositoryImplement::class
        );
        $this->app->bind(
            UserDataRepository::class,
            UserDataRepositoryImplement::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(200);
    }
}
