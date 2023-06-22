<?php

namespace App\Repositories\ServiceMegalos;

use App\Helpers\AccessControlHelper;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Services;
use Yajra\DataTables\Facades\DataTables;

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
     * Retrieves records from a database, initializes DataTables, adds columns to DataTable.
     * @return DataTables Yajra JSON response.
     */
    public function getDatatables()
    {
        // Retrieve records from the database using the model, including the related 'services' records, and sort by the latest records
        $data = $this->model->select('id', 'service_name', 'cost', 'currency','idle_timeout', 'ul_rate','dl_rate')->orderBy('id', 'DESC')->get();

        // Initialize DataTables and add columns to the table
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('currency_cost', function ($data) {
                return $data->currency . ' ' . number_format($data->cost, 2);
            })
            ->addColumn('idle_timeout', function ($data) {
                return $data->idle_timeout . ' Seconds';
            })
            ->addColumn('upload_rate', function ($data) {
                return $data->ul_rate . ' Kbps';
            })
            ->addColumn('download_rate', function ($data) {
                return $data->dl_rate . ' Kbps';
            })
            ->addColumn('action', function ($data) {
                $editButton = '';
                $deleteButton = '';

                // Check if the current service is allowed to edit
                if (AccessControlHelper::isAllowedToPerformAction('edit_service')) {
                    // If service is allowed, show edit button
                    $editButton = '<button type="button" name="edit" class="edit btn btn-primary btn-sm" onclick="showService(\'' . $data->id . '\')"> <i class="fas fa-edit"></i></button>';
                }

                // Check if the current service is allowed to delete
                if (AccessControlHelper::isAllowedToPerformAction('delete_service')) {
                    // If service is allowed, show delete button
                    $deleteButton = '&nbsp;&nbsp;<button type="button" class="delete btn btn-danger btn-sm" onclick="confirmDeleteService(\'' . $data->id . '\')"> <i class="fas fa-trash"></i></button>';
                }

                return $editButton . $deleteButton;
            })
            ->rawColumns(['action'])
            ->make(true);

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
