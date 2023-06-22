<?php

namespace App\Repositories\ServiceMegalos;

use LaravelEasyRepository\Repository;

interface ServiceMegalosRepository extends Repository{

    /**
     * Retrieves records from a database, initializes DataTables, adds columns to DataTable.
     * @return DataTables Yajra JSON response.
     */
    public function getDatatables();

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
