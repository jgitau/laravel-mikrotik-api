<?php

namespace App\Services\Client;

use LaravelEasyRepository\BaseService;

interface ClientService extends BaseService{

    /**
     * Retrieve all client records and associated service names.
     * Conditionally applies a WHERE clause if provided.
     * @param array|null $conditions
     * @return array
     */
    public function getAllWithService($conditions);

    /**
     * Retrieves records from a database, initializes DataTables, adds columns to DataTable.
     * @return DataTables Yajra JSON response.
     */
    public function getDatatables();

    /**
     * Define validation rules for client creation.
     * @return array Array of validation rules
     */
    public function getRules();

    /**
     * Define validation messages for client creation.
     * @return array Array of validation messages
     */
    public function getMessages();

    /**
     * Stores a new client using the provided request data.
     * @param array $request The data used to create the new client.
     * @return Model|mixed The newly created client.
     * @throws \Exception if an error occurs while creating the client.
     */
    public function storeNewClient($request);
}
