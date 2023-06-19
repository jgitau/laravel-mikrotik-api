<?php

namespace App\Repositories\Config\Ads;

use App\Helpers\AccessControlHelper;
use App\Models\Ad;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AdsRepositoryImplement extends Eloquent implements AdsRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;
    protected $adModel;

    public function __construct(Setting $model, Ad $adModel)
    {
        $this->model = $model;
        $this->adModel = $adModel;
    }

    /**
     * getAdsParameters
     * @return void
     */
    public function getAdsParameters()
    {
        // Get 2 line from setting table based on setting
        $ads = $this->model->whereIn(
            'setting',
            [
                'ads_max_width',
                'ads_max_height',
                'ads_max_size',
                'ads_upload_folder',
                'ads_thumb_width',
                'ads_thumb_height',
                'mobile_ads_max_width',
                'mobile_ads_max_height',
                'mobile_ads_max_size',
            ]
        )->get();

        return $ads;
    }

    /**
     * updateAdsSettings
     * @param  mixed $settings
     * @return void
     */
    public function updateAdsSettings($settings)
    {
        foreach ($settings as $key => $value) {
            $this->model->updateOrCreate(
                ['setting' => $key],
                ['value' => $value]
            );
        }
    }

    /**
     * Retrieves records from a database, initializes DataTables, adds columns to DataTable.
     * @return DataTables Yajra JSON response.
     */
    public function getDatatables()
    {
        // Retrieve records from the database using the AdModel, and sort by the latest records
        $data = $this->adModel->latest()->get();

        // Initialize DataTables and add columns to the table
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('image', function ($data) {
                // The image path could vary depending on your implementation, adjust accordingly
                $url = asset('files/images/' . $data->file_name);
                return '<img src="' . $url . '" border="0" width="100" class="rounded" align="center" />';
            })
            ->addColumn('action', function ($data) {
                $editButton = '';
                $deleteButton = '';

                // Check if the current ads is allowed to edit
                if (AccessControlHelper::isAllowedToPerformAction('edit_ad')) {
                    // If ads is allowed, show edit button
                    $editButton = '<button type="button" name="edit" class="edit btn btn-primary btn-sm" onclick="showAd(\'' . $data->id . '\')"> <i class="fas fa-edit"></i></button>';
                }

                // Check if the current ads is allowed to delete
                if (AccessControlHelper::isAllowedToPerformAction('delete_ad')) {
                    // If ads is allowed, show delete button
                    $deleteButton = '&nbsp;&nbsp;<button type="button" class="delete btn btn-danger btn-sm" onclick="confirmDeleteAd(\'' . $data->id . '\')"> <i class="fas fa-trash"></i></button>';
                }

                return $editButton . $deleteButton;
            })
            ->rawColumns(['action', 'image'])
            ->make(true);
    }

    /**
     * Stores a new ad using the provided request data.
     * @param array $request The data used to create the new ad.
     * @return Model|mixed The newly created ad.
     * @throws \Exception if an error occurs while creating the ad.
     */
    public function storeNewAd($request)
    {
        try {
            // Generate unique names for the files
            $newFileName = $this->generateFileName($request['imageBanner']);
            $thumbFileName = $this->generateFileName($request['imageBanner'], true);
            // Save the banner image
            $this->storeBannerImage($request['imageBanner'], $newFileName);

            // Create and return a new ad
            return $this->createAd($request, $newFileName, $thumbFileName);
        } catch (\Exception $e) {
            // If an exception occurred during the create process, log the error message.
            Log::error("Error in Store New Ad: " . $e->getMessage());

            // Rethrow the exception to be caught in the Livewire component.
            throw $e;
        }
    }

    /**
     * Updates an existing ad using the provided request data.
     * @param array $request The data used to update the ad.
     * @param int $id The ID of the ad to update.
     * @return Model|mixed The updated ad.
     * @throws \Exception if an error occurs while updating the ad.
     */
    public function updateAd($request, $id)
    {
        try {
            // Find the ad to update
            $ad = $this->adModel->findOrFail($id);
            // Check if the imageBanner exists in the request
            if (isset($request['imageBanner']) && !empty($request['imageBanner'])) {
                // Generate unique names for the files
                $newFileName = $this->generateFileName($request['imageBanner']);
                $thumbFileName = $this->generateFileName($request['imageBanner'], true);

                // Delete the old banner image
                $this->deleteBannerImage($ad->file_name);

                // Save the new banner image
                $this->storeBannerImage($request['imageBanner'], $newFileName);
            } else {
                // Use the existing file names if imageBanner doesn't exist in the request
                $newFileName = $ad->file_name;
                $thumbFileName = $ad->thumb_file_name;
            }

            // Update and return the ad
            return $this->updateAdData($ad, $request, $newFileName, $thumbFileName);
        } catch (\Exception $e) {
            // If an exception occurred during the update process, log the error message.
            Log::error("Error in Update Ad: " . $e->getMessage());

            // Rethrow the exception to be caught in the Livewire component.
            throw $e;
        }
    }

    /**
     * Deletes an existing ad and its associated images.
     * @param int $id The ID of the ad to delete.
     * @throws \Exception if an error occurs while deleting the ad.
     */
    public function deleteAd($id)
    {
        try {
            // Find the ad to delete
            $ad = $this->adModel->findOrFail($id);

            // Delete the banner image
            $this->deleteBannerImage($ad->file_name);

            // Delete the ad
            $ad->delete();
        } catch (\Exception $e) {
            // If an exception occurred during the delete process, log the error message.
            Log::error("Error in Delete Ad: " . $e->getMessage());

            // Rethrow the exception to be caught in the Livewire component.
            throw $e;
        }
    }

    // **** Private Methods ****

    /**
     * Generates a unique file name.
     * @param UploadedFile $file The uploaded file.
     * @param bool $thumb Whether or not the file is a thumbnail.
     * @return string The generated file name.
     */
    private function generateFileName($file, $thumb = false)
    {
        $suffix = $thumb ? '_thumb' : '';
        return "ads_" . str()->random(10) . $suffix . '.' . $file->getClientOriginalExtension();
    }

    /**
     * Stores the given banner image using the provided file name.
     * @param UploadedFile $file The file to store.
     * @param string $fileName The name to give to the stored file.
     * @throws \Exception if an error occurs while storing the file.
     */
    private function storeBannerImage($file, $fileName)
    {
        $storagePath = 'files/images/' . $fileName;
        if (!Storage::disk('server')->put($storagePath, file_get_contents($file->getRealPath()))) {
            throw new \Exception('Failed to save logo.');
        }
    }

    /**
     * Creates a new ad using the provided data.
     * @param array $data The data used to create the new ad.
     * @param string $fileName The name of the ad's banner image file.
     * @param string $thumbFileName The name of the ad's thumbnail file.
     * @return AdModel|mixed The newly created ad.
     */
    private function createAd($data, $fileName, $thumbFileName)
    {
        return $this->adModel->create([
            'file_name'          => $fileName,
            'thumb_file_name'    => $thumbFileName,
            'type'               => $data['type'],
            'device_type'        => $data['deviceType'],
            'title'              => $data['title'],
            'url_for_image'      => $data['urlForImage'],
            'position'           => $data['position'] ?? " ",
            'time_to_show'       => strtotime($data['timeToShow']) ?? 0,
            'time_to_hide'       => strtotime($data['timeToHide']) ?? 0,
            'short_description'  => $data['shortDescription'],
        ]);
    }

    /**
     * Deletes the given banner image.
     * @param string $fileName The name of the file to delete.
     * @throws \Exception if an error occurs while deleting the file.
     */
    private function deleteBannerImage($fileName)
    {
        $storagePath = 'files/images/' . $fileName;
        if (Storage::disk('server')->exists($storagePath)) {
            if (!Storage::disk('server')->delete($storagePath)) {
                throw new \Exception('Failed to delete image.');
            }
        }
    }

    /**
     * Updates the given ad using the provided data.
     * @param Model $ad The ad to update.
     * @param array $data The data used to update the ad.
     * @param string $fileName The name of the ad's banner image file.
     * @param string $thumbFileName The name of the ad's thumbnail file.
     * @return AdModel|mixed The updated ad.
     */
    private function updateAdData($ad, $data, $fileName, $thumbFileName)
    {
        $ad->file_name = $fileName;
        $ad->thumb_file_name = $thumbFileName;
        $ad->type = $data['type'];
        $ad->device_type = $data['deviceType'];
        $ad->title = $data['title'];
        $ad->url_for_image = $data['urlForImage'];
        $ad->position = $data['position'] ?? " ";
        $ad->time_to_show = strtotime($data['timeToShow']) ?? 0;
        $ad->time_to_hide = strtotime($data['timeToHide']) ?? 0;
        $ad->short_description = $data['shortDescription'];

        $ad->save();

        return $ad;
    }
}
