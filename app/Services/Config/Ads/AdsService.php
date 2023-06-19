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

    /**
     * Retrieves records from a database, initializes DataTables, adds columns to DataTable.
     * @return DataTables Yajra JSON response.
     */
    public function getDatatables();

    /**
     * storeNewAd
     * @param  mixed $request
     * @return void
     */
    public function storeNewAd($request);

}
