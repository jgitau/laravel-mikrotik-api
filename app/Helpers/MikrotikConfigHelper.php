<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class MikrotikConfigHelper
{
    public static function getMikrotikConfig()
    {
        $config = [];

        try {
            $config['ip'] = Setting::where('setting', 'mikrotik_ip')->first()->value;
            $config['port'] = Setting::where('setting', 'mikrotik_api_port')->first()->value;
            $config['username'] = Setting::where('setting', 'mikrotik_api_username')->first()->value;
            $config['password'] = Crypt::decryptString(Setting::where('setting', 'mikrotik_api_password')->first()->value);
            if (in_array(null, $config, true)) {
                throw new \Exception('Some Mikrotik configurations are missing in the database');
            }
        } catch (\Exception $e) {
            Log::error('Failed to get Mikrotik configuration: ' . $e->getMessage());
            return null;
        }

        return $config;
    }
}
