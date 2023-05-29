<?php

namespace App\Services\ServiceMegalos;

use LaravelEasyRepository\BaseService;

interface ServiceMegalosService extends BaseService{

    /**
     * getServices
     *
     * @return void
     */
    public function getServices();


    /**
     * storeHotelRoomService
     *
     * @param  mixed $request
     * @return void
     */
    public function storeHotelRoomService($request);

    /**
     * deleteService
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteService($id);
}
