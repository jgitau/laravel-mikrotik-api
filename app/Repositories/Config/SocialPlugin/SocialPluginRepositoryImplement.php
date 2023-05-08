<?php

namespace App\Repositories\Config\SocialPlugin;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Setting;

class SocialPluginRepositoryImplement extends Eloquent implements SocialPluginRepository{

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


    public function getSocialPluginParameters()
    {
        // Get 2 line from setting table based on setting
        $ads = $this->model->whereIn(
            'setting',
            [
                'fb_app_id',
                'fb_app_secret',
                'tw_api_key',
                'tw_api_secret',
                'google_api_client_id',
                'login_with_facebook_on',
                'login_with_twitter_on',
                'login_with_google_on',
                'login_with_linkedin_on',
                'google_api_client_secret',
                'linkedin_api_client_id',
                'linkedin_api_client_secret',
            ]
        )->get();

        return $ads;
    }

    /**
     * This function updates or creates social plugin settings in a database based on the provided
     * key-value pairs.
     *
     * @param settings The  parameter is an array that contains key-value pairs representing
     * the social plugin settings to be updated or created. The keys represent the name of the setting,
     * while the values represent the new value to be set for that setting.
     */
    public function updateSocialPluginSettings($settings)
    {
        foreach ($settings as $key => $value) {
            $this->model->updateOrCreate(
                ['setting' => $key],
                ['value' => $value]
            );
        }
    }
}
