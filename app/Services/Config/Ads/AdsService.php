<?php

namespace App\Services\Config\Ads;

use LaravelEasyRepository\BaseService;

interface AdsService extends BaseService{

    /**
     * getAdsParameters
     *
     * @return void
     */
    public function getAdsParameters();

    /**
     * updateAdsSettings
     *
     * @param  mixed $settings
     * @return void
     */
    public function updateAdsSettings($settings);

}
