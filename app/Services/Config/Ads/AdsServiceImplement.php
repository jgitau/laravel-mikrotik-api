<?php

namespace App\Services\Config\Ads;

use LaravelEasyRepository\Service;
use App\Repositories\Config\Ads\AdsRepository;
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
}
