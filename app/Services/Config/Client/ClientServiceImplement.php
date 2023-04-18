<?php

namespace App\Services\Config\Client;

use App\Repositories\Config\Client\ClientRepository;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;

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
     * getClientParameters
     */
    public function getClientParameters()
    {
        try {
            return $this->mainRepository->getClientParameters();
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
        }
    }

    /**
     * updateClientSettings
     *
     * @param  mixed $settings
     * @return void
     */
    public function updateClientSettings($settings)
    {
        try {
            $this->mainRepository->updateClientSettings($settings);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
        }
    }
}
