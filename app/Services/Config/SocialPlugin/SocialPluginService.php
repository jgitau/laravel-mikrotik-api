<?php

namespace App\Services\Config\SocialPlugin;

use LaravelEasyRepository\BaseService;

interface SocialPluginService extends BaseService{

    /**
     * getSocialPluginParameters
     *
     * @return void
     */
    public function getSocialPluginParameters();


    /**
     * updateSocialPluginSettings
     *
     * @param  mixed $settings
     * @return void
     */
    public function updateSocialPluginSettings($settings);
}
