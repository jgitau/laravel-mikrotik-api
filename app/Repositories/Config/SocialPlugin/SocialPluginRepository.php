<?php

namespace App\Repositories\Config\SocialPlugin;

use LaravelEasyRepository\Repository;

interface SocialPluginRepository extends Repository{

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
