<?php

namespace App\Services\Config\SocialPlugin;

use LaravelEasyRepository\Service;
use App\Repositories\SocialPlugin\SocialPluginRepository;

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

    // Define your custom methods :)
}
