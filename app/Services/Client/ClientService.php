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
}
