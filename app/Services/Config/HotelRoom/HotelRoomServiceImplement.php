<?php

namespace App\Services\Config\HotelRoom;

use LaravelEasyRepository\Service;
use App\Repositories\Config\HotelRoom\HotelRoomRepository;
use Illuminate\Support\Facades\Log;

class HotelRoomServiceImplement extends Service implements HotelRoomService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(HotelRoomRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    /**
     * getHotelRoomParameters
     */
    public function getHotelRoomParameters()
    {
        try {
            return $this->mainRepository->getHotelRoomParameters();
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
        }
    }


    /**
     * updateHotelRoomSettings
     *
     * @param  mixed $settings
     * @return void
     */
    public function updateHotelRoomSettings($settings)
    {
        try {
            return $this->mainRepository->updateHotelRoomSettings($settings);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
        }
    }

    /**
     * getDatatables
     */
    public function getDatatables()
    {
        try {
            return $this->mainRepository->getDatatables();
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return [];
            //throw $th;
        }
    }


}
