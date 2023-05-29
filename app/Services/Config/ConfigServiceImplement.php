<?php

namespace App\Services\Config;

use LaravelEasyRepository\Service;
use App\Repositories\Config\ConfigRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class ConfigServiceImplement extends Service implements ConfigService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(ConfigRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    /**
     * getDatatables
     */
    public function getDatatables()
    {
        try {
            return $this->mainRepository->getDatatables();
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
            return [];
            //throw $th;
        }
    }

    /**
     * getUrlRedirect
     */
    public function getUrlRedirect()
    {
        try {
            return $this->mainRepository->getUrlRedirect();
        } catch (Exception $exception) {
            throw new Exception("Error getting URL Redirect : " . $exception->getMessage());
        }
    }

    /**
     * updateUrlRedirect
     * @param  mixed $request
     * @return void
     */
    public function updateUrlRedirect($request)
    {
        try {
            return $this->mainRepository->updateUrlRedirect($request);
        } catch (Exception $exception) {
            throw new Exception("Error updating URL Redirect : " . $exception->getMessage());
        }
    }
}
