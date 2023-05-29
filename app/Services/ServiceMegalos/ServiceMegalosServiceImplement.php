<?php

namespace App\Services\ServiceMegalos;

use LaravelEasyRepository\Service;
use App\Repositories\ServiceMegalos\ServiceMegalosRepository;
use Illuminate\Support\Facades\Log;

class ServiceMegalosServiceImplement extends Service implements ServiceMegalosService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(ServiceMegalosRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function getServices()
    {
        try {
            return $this->mainRepository->getServices();
        } catch (\Throwable $th) {
            return Log::debug($th->getMessage());
        }
    }

    /**
     * storeHotelRoomService
     *
     * @param  mixed $request
     * @return void
     */
    public function storeHotelRoomService($request)
    {
        try {
            return $this->mainRepository->storeHotelRoomService($request);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
        }
    }
}
