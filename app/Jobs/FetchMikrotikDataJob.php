<?php

namespace App\Jobs;

use App\Helpers\MikrotikConfigHelper;
use App\Services\MikrotikApi\MikrotikApiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class FetchMikrotikDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     * @return void
     */
    public function handle(MikrotikApiService $mikrotikApiService)
    {
        // Retrieve the Mikrotik configuration settings.
        $config = MikrotikConfigHelper::getMikrotikConfig();

        // Check if the configuration exists and no values are empty.
        if ($config && !in_array("", $config, true)) {

            // Try to retrieve Mikrotik resource data using Mikrotik API service. On exception, set data to null.
            try {
                // Retrieve data from Mikrotik router using Mikrotik API Curl service.
                $data = $mikrotikApiService->getMikrotikUserActive($config['ip'], $config['username'], $config['password']);
            } catch (\Exception $e) {
                $data = [
                    'userActive' => 0,
                    'ipBindingBypassed' => 0,
                    'ipBindingBlocked' => 0,

                ];
            }

            $userActive = $data['userActive'] ?? 0;
            $ipBindingBypassed = $data['ipBindingBypassed'] ?? 0;
            $ipBindingBlocked = $data['ipBindingBlocked'] ?? 0;

            // Store data in cache for a single retrieval
            Cache::put('userActive', $userActive, 10); // Keep the data for 10 minutes
            Cache::put('ipBindingBypassed', $ipBindingBypassed, 10); // Keep the data for 10 minutes
            Cache::put('ipBindingBlocked', $ipBindingBlocked, 10); // Keep the data for 10 minutes
        }
    }
}
