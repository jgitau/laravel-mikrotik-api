<?php

namespace App\Services\ServiceMegalos;

use LaravelEasyRepository\BaseService;

interface ServiceMegalosService extends BaseService{

    /**
     * Retrieves records from a database, initializes DataTables, adds columns to DataTable.
     * @return DataTables Yajra JSON response.
     */
    public function getDatatables();

    /**
     * Define validation rules for service creation.
     * @param object $request The rules data used to create the new service.
     * @param string|null $serviceId Service ID for uniqueness checks. If not provided, a create operation is assumed.
     * @return array Array of validation rules
     */
    public function getRules($request, $serviceId = null);

    /**
     * Define validation messages for service creation.
     * @return array Array of validation messages
     */
    public function getMessages();

    /**
     * Stores a new service using the provided request data.
     * @param array $request The data used to create the new service.
     * @return Model|mixed The newly created service.
     * @throws \Exception if an error occurs while creating the service.
     */
    public function storeNewService($request);

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
