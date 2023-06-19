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
     * Stores a new ad using the provided request data.
     * @param array $request The data used to create the new ad.
     * @return Model|mixed The newly created ad.
     * @throws \Exception if an error occurs while creating the ad.
     */
    public function storeNewAd($request);

    /**
     * Updates an existing ad using the provided request data.
     * @param array $request The data used to update the ad.
     * @param int $id The ID of the ad to update.
     * @return Model|mixed The updated ad.
     * @throws \Exception if an error occurs while updating the ad.
     */
    public function updateAd($request, $id);

    /**
     * Deletes an existing ad and its associated images.
     * @param int $id The ID of the ad to delete.
     * @throws \Exception if an error occurs while deleting the ad.
     */
    public function deleteAd($id);

}
