<?php

namespace App\Services\Config\HotelRoom;

use LaravelEasyRepository\BaseService;

interface HotelRoomService extends BaseService{

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
