<?php

namespace App\Services\Config\Ads;

use LaravelEasyRepository\Service;
use App\Repositories\Config\Ads\AdsRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class AdsServiceImplement extends Service implements AdsService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(AdsRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    /**
     * getAdsParameters
     */
    public function getAdsParameters()
    {
        try {
            return $this->mainRepository->getAdsParameters();
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
        }
    }

    /**
     * updateAdsSettings
     *
     * @param  mixed $settings
     * @return void
     */
    public function updateAdsSettings($settings)
    {
        try {
            return $this->mainRepository->updateAdsSettings($settings);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
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
            throw new Exception("Error get datatables ads : " . $exception->getMessage());
        }
    }

    /**
     * storeNewAd
     * @param  mixed $request
     * @return void
     */
    public function storeNewAd($request)
    {
        try {
            return $this->mainRepository->storeNewAd($request);
        } catch (Exception $exception) {
            throw new Exception("Error to store new ad : " . $exception->getMessage());
        }
    }
}
