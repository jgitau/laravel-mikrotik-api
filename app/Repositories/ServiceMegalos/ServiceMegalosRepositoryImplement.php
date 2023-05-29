<?php

namespace App\Repositories\ServiceMegalos;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Services;

class ServiceMegalosRepositoryImplement extends Eloquent implements ServiceMegalosRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Services $model)
    {
        $this->model = $model;
    }

    /**
     * @return a collection of services that have a non-null `cron_type` field and a non-empty `cron`
     * field, with only the `id`, `service_name`, `cron_type`, and `cron` fields selected. The `cron`
     * field is also filtered to exclude any values that are equal to an empty string or zero.
     */
    public function getServices()
    {
        return $this->model->select('id', 'service_name', 'cron_type', 'cron')->get();
    }

    /**
     * storeHotelRoomService
     *
     * @param  mixed $request
     * @return void
     */
    public function storeHotelRoomService($request)
    {
        // Check if idService is in the request
        if (!array_key_exists('idService', $request)) {
            throw new \InvalidArgumentException("idService is empty in the request");
        }

        // Update the service
        $service = $this->model->where('id', $request['idService'])
            ->update([
                'cron' => 1,
                'cron_type' => $request['cronType'],
            ]);

        // Check if service exists
        if (!$service) {
            throw new \RuntimeException("Service with id {$request['idService']} not found");
        }

        // Return the updated service
        return $service;
    }


    /**
     * deleteService
     *
     * @param  mixed $request
     * @return void
     */
    public function deleteService($id)
    {
        // Delete the service
        $service = $this->model->where('id', $id)
            ->update([
                'cron' => 0,
                'cron_type' => "",
            ]);

        // Check if service exists
        if (!$service) {
            throw new \RuntimeException("Service with id {$id} not found");
        }

        // Return the updated service
        return $service;
    }

}
