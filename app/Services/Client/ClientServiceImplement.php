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
     * Retrieve client records and associated service names.
     * Conditionally applies a WHERE clause if provided.
     * @param array|null $conditions
     * @return array
     */
    public function getClientWithService($conditions = null)
    {
        try {
            return $this->mainRepository->getClientWithService($conditions);
        } catch (Exception $exception) {
            throw new Exception("Error getting data clients : " . $exception->getMessage());
        }
    }

    /**
     * Retrieve client by uid.
     * Conditionally applies a WHERE clause if provided.
     * @param array|null $clientUid
     * @return array
     */
    public function getClientByUid($clientUid)
    {
        try {
            return $this->mainRepository->getClientByUid($clientUid);
        } catch (Exception $exception) {
            throw new Exception("Error getting data client by uid : " . $exception->getMessage());
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
     * @param string|null $clientUid Client UID for uniqueness checks. If not provided, a create operation is assumed.
     * @return array Array of validation rules
     */
    public function getRules($clientUid)
    {
        try {
            return $this->mainRepository->getRules($clientUid);
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

    /**
     * Updates an existing client using the provided data.
     * @param string $clientUid The UID of the client to update.
     * @param array $data The data used to update the client.
     * @return Model|mixed The updated client.
     * @throws \Exception if an error occurs while updating the client.
     */
    public function updateClient($clientUid, $data)
    {
        try {
            return $this->mainRepository->updateClient($clientUid, $data);
        } catch (Exception $exception) {
            throw new Exception("Error updating client : " . $exception->getMessage());
        }
    }

    /**
     * Delete client data from the `clients`, `radcheck`, `radacct`, and `radusergroup` tables based on the client UID.
     * @param string $clientUid The UID of the client to delete.
     */
    public function deleteClientData($clientUid)
    {
        try {
            return $this->mainRepository->deleteClientData($clientUid);
        } catch (Exception $exception) {
            throw new Exception("Error creating client : " . $exception->getMessage());
        }
    }
}
