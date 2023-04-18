<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use App\Repositories\Config\Client\ClientRepository;
use App\Repositories\Config\Client\ClientRepositoryImplement;
use App\Repositories\Config\HotelRoom\HotelRoomRepository;
use App\Repositories\Config\HotelRoom\HotelRoomRepositoryImplement;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Instantiable class binding
        $this->app->bind(
            ClientRepository::class,
            ClientRepositoryImplement::class
        );

        $this->app->bind(
            HotelRoomRepository::class,
            HotelRoomRepositoryImplement::class
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
