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

    /**
     * Define validation rules for client creation.
     * @return array Array of validation rules
     */
    public function getRules()
    {
        try {
            return $this->mainRepository->getRules();
        } catch (Exception $exception) {
            throw new Exception("Error getting rules clients : " . $exception->getMessage());
        }
    }

    /**
     * Define validation messages for client creation.
     * @return array Array of validation messages
     */
    public function getMessages()
    {
        try {
            return $this->mainRepository->getMessages();
        } catch (Exception $exception) {
            throw new Exception("Error getting messages rules clients : " . $exception->getMessage());
        }
    }

    /**
     * Stores a new client using the provided request data.
     * @param array $request The data used to create the new client.
     * @return Model|mixed The newly created client.
     * @throws \Exception if an error occurs while creating the client.
     */
    public function storeNewClient($request)
    {
        try {
            return $this->mainRepository->StoreNewClient($request);
        } catch (Exception $exception) {
            throw new Exception("Error creating client : " . $exception->getMessage());
        }
    }
}
