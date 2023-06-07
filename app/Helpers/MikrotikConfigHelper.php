<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class MikrotikConfigHelper
{
    /**
     * Retrieves Mikrotik configuration from the database.
     * @return array|null The Mikrotik configuration details, or null if any detail is missing.
     */
    public static function getMikrotikConfig()
    {
        // Initialize configuration array
        $config = [];

        try {
            // Fetch each configuration setting from the database
            $config['ip'] = Setting::where('setting', 'mikrotik_ip')->first()->value;
            $config['port'] = Setting::where('setting', 'mikrotik_api_port')->first()->value;
            $config['username'] = Setting::where('setting', 'mikrotik_api_username')->first()->value;

            // Decrypt and fetch the password
            // $config['password'] = Crypt::decryptString(Setting::where('setting', 'mikrotik_api_password')->first()->value);
            $config['password'] = Setting::where('setting', 'mikrotik_api_password')->first()->value;

            // If any configuration setting is missing, throw an exception
            if (in_array(null, $config, true)) {
                throw new \Exception('Some Mikrotik configurations are missing in the database');
            }
        } catch (\Exception $e) {
            // Log any error encountered and return null
            Log::error('Failed to get Mikrotik configuration: ' . $e->getMessage());
            return null;
        }

        // Return the fetched configuration
        return $config;
    }
}
