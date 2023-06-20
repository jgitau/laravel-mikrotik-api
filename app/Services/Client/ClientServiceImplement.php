<?php

namespace App\Services\Client;

use LaravelEasyRepository\Service;
use App\Repositories\Client\ClientRepository;
use Exception;

class ClientServiceImplement extends Service implements ClientService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(ClientRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
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
            return $this->mainRepository->getAllWithService($conditions);
        } catch (Exception $exception) {
            throw new Exception("Error getting data clients : " . $exception->getMessage());
        }
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
}
