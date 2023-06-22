<?php

namespace App\Services\ServiceMegalos;

use LaravelEasyRepository\Service;
use App\Repositories\ServiceMegalos\ServiceMegalosRepository;
use Exception;
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

    /**
     * Retrieves records from a database, initializes DataTables, adds columns to DataTable.
     * @return DataTables Yajra JSON response.
     */
    public function getDatatables()
    {
        try {
            return $this->mainRepository->getDatatables();
        } catch (Exception $exception) {
            throw new Exception("Error getting data to datatable : " . $exception->getMessage());
        }
    }

    /**
     * @return The `getServices()` function is returning the result of calling the `getServices()`
     * method on the `` object.
     */
    public function getServices()
    {
        try {
            return $this->mainRepository->getServices();
        } catch (Exception $exception) {
            throw new Exception("Error getting services: " . $exception->getMessage());
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
        } catch (Exception $exception) {
            throw new Exception("Error storing hotel room service: " . $exception->getMessage());
        }
    }

    /**
     * deleteService
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteService($id)
    {
        try {
            return $this->mainRepository->deleteService($id);
        } catch (Exception $exception) {
            throw new Exception("Error deleting service: " . $exception->getMessage());
        }
    }
}
