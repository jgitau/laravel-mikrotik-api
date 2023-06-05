<?php

namespace App\Http\Controllers\Backend\Setup\Config;

use App\Helpers\AccessControlHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * The function returns a view for the index page of a backend setup configuration.
     *
     * @return View called "backend.setup.configs.index" is being returned.
     */
    public function index()
    {
        // Check if the user is allowed to list configurations
        $isAllowedToListConfig = AccessControlHelper::isAllowedToPerformAction('list_config');
        return view('backend.setup.configs.index', [
            'isAllowedToListConfig' => $isAllowedToListConfig
        ]);
    }

    public function hotel_rooms()
    {
        // Check if the user is allowed to list configurations Hotel Rooms
        $isAllowedToConfigHotelRooms = AccessControlHelper::isAllowedToPerformAction('config_hotel_rooms');
        return view('backend.setup.configs.hotel_rooms', [
            'isAllowedToConfigHotelRooms' => $isAllowedToConfigHotelRooms
        ]);
    }
}
