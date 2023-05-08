<?php

namespace App\Services\Config\SocialPlugin;

use LaravelEasyRepository\Service;
use App\Repositories\Config\SocialPlugin\SocialPluginRepository;
use Illuminate\Support\Facades\Log;

class SocialPluginServiceImplement extends Service implements SocialPluginService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(SocialPluginRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    /**
     * This function tries to retrieve social plugin parameters from the main repository and logs any
     * errors.
     *
     * @return The `getSocialPluginParameters()` function is returning the result of calling the
     * `getSocialPluginParameters()` method on the `` object. If an exception is caught,
     * the function logs the error message using the `Log::debug()` method. The return value of the
     * function depends on the implementation of the `getSocialPluginParameters()` method in the
     * `` object.
     */
    public function getSocialPluginParameters()
    {
        try {
            return $this->mainRepository->getSocialPluginParameters();
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
        }
    }

    /**
     * This function updates social plugin settings and logs any errors that occur.
     *
     * @param settings The parameter `` is an array containing the updated settings for a
     * social plugin. The function `updateSocialPluginSettings` is responsible for updating the social
     * plugin settings in the main repository with the new values provided in the `` array. If
     * the update is successful, the function returns the updated
     *
     * @return the result of calling the `updateSocialPluginSettings` method on the `mainRepository`
     * object with the `` parameter.
     */
    public function updateSocialPluginSettings($settings)
    {
        try {
            return $this->mainRepository->updateSocialPluginSettings($settings);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
        }
    }
}
