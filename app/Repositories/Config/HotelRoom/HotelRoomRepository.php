<?php

namespace App\Repositories\Config\HotelRoom;

use LaravelEasyRepository\Repository;

interface HotelRoomRepository extends Repository{


    /**
     * getHotelRoomParameters
     *
     * @return void
     */
    public function getHotelRoomParameters();

    /**
     * updateHotelRoomSettings
     *
     * @param  mixed $settings
     * @return void
     */
    public function updateHotelRoomSettings($settings);
}
