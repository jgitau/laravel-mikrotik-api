<?php

namespace App\Repositories\ServiceMegalos;

use LaravelEasyRepository\Repository;

interface ServiceMegalosRepository extends Repository{

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
