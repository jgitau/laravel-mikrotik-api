<?php

namespace App\Repositories\MikrotikApi;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\RouterOsApi;
use Illuminate\Support\Facades\Log;

class MikrotikApiRepositoryImplement extends Eloquent implements MikrotikApiRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(RouterOsApi $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)


    /**
     * Retrieves Mikrotik interface data via RouterOS API.
     * @param string $ip Mikrotik router IP address.
     * @param string $username Authentication username.
     * @param string $password Authentication password.
     * @return array|null Mikrotik interface data or null on connection failure.
     */
    public function getMikrotikUserActive($ip, $username, $password)
    {
        try {
            // Connect to the Mikrotik router. If connection fails, log the error and return null.
            if (!$this->model->connect($ip, $username, $password)) {
                Log::error('Failed to connect to Mikrotik router: ' . $ip);
                return null;
            }

            // Fetch list of active users and IP bindings
            $userActive = $this->model->comm("/ip/hotspot/active/print");
            $ipBindings = $this->model->comm("/ip/hotspot/ip-binding/print");

            // Filter bypassed IP bindings
            $ipBindingBypassed = array_filter($ipBindings, function ($binding) {
                return isset($binding['type']) && $binding['type'] === 'bypassed';
            });

            // Filter blocked IP bindings
            $ipBindingBlocked = array_filter($ipBindings, function ($binding) {
                return isset($binding['type']) && $binding['type'] === 'blocked';
            });

            // Return the counts of active users, bypassed and blocked IP bindings
            return [
                'userActive' => count($userActive),
                'ipBindingBypassed' => count($ipBindingBypassed),
                'ipBindingBlocked' => count($ipBindingBlocked),
            ];
        } catch (\Exception $e) {
            // If any error occurs, log the error message and return null
            Log::error('Failed to get Mikrotik interface data: ' . $e->getMessage());
            return null;
        }
    }
}
