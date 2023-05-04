<?php

namespace App\Repositories\Config\Ads;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Setting;

class AdsRepositoryImplement extends Eloquent implements AdsRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    /**
     * getAdsParameters
     *
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
     *
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

}
