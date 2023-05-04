<?php

namespace App\Repositories\Config\Ads;

use LaravelEasyRepository\Repository;

interface AdsRepository extends Repository{

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
