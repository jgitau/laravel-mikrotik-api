<?php

namespace App\Repositories\Client;

use App\Helpers\AccessControlHelper;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Client;
use Exception;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class ClientRepositoryImplement extends Eloquent implements ClientRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Client $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve all client records and associated service names.
     * Conditionally applies a WHERE clause if provided.
     * @param array|null $conditions
     * @return array
     */
    public function getAllWithService($conditions = null)
    {
        try {
            // Prepare the query to select clients and join with services
            $clientQuery = $this->model::select('clients.*', 'services.service_name')
                ->leftJoin('services', 'clients.service_id', '=', 'services.id');

            // Add the 'where' conditions if they exist
            if ($conditions) {
                $clientQuery = $clientQuery->where($conditions);
            }

            // Get the results and the count of rows
            $clientData['data'] = $clientQuery->get()->toArray();
            $clientData['total'] = $clientQuery->count();

            return $clientData;
        } catch (Exception $e) {
            // Log the exception message and return an empty array
            Log::error("Error getting data clients : " . $e->getMessage());
        }

        return false;
    }

    /**
     * Retrieves records from a database, initializes DataTables, adds columns to DataTable.
     * @return DataTables Yajra JSON response.
     */
    public function getDatatables()
    {
        // Retrieve records from the database using the model, including the related 'clients' records, and sort by the latest records
        $data = $this->model->select('clients.client_uid', 'clients.username', 'services.service_name')
        ->leftJoin('services', 'clients.service_id', '=', 'services.id')
        ->latest()
        ->get();

        // Initialize DataTables and add columns to the table
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $editButton = '';
                $deleteButton = '';

                // Check if the current client is allowed to edit
                if (AccessControlHelper::isAllowedToPerformAction('edit_client')) {
                    // If client is allowed, show edit button
                    $editButton = '<button type="button" name="edit" class="edit btn btn-primary btn-sm" onclick="showClient(\'' . $data->client_uid . '\')"> <i class="fas fa-edit"></i></button>';
                }

                // Check if the current client is allowed to delete
                if (AccessControlHelper::isAllowedToPerformAction('delete_client')) {
                    // If client is allowed, show delete button
                    $deleteButton = '&nbsp;&nbsp;<button type="button" class="delete btn btn-danger btn-sm" onclick="confirmDeleteClient(\'' . $data->client_uid . '\')"> <i class="fas fa-trash"></i></button>';
                }

                return $editButton . $deleteButton;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
