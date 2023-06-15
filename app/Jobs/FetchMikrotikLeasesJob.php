<?php

namespace App\Jobs;

use App\Helpers\MikrotikConfigHelper;
use App\Services\MikrotikApi\MikrotikApiService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class FetchMikrotikLeasesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(MikrotikApiService $mikrotikApiService)
    {
        // Retrieve the Mikrotik configuration settings.
        $config = MikrotikConfigHelper::getMikrotikConfig();

        // Check if the configuration exists and no values are empty.
        if ($config && !in_array("", $config, true)) {

            // Try to retrieve Mikrotik DHCP Leases data using Mikrotik API service.
            try {
                $dhcpLeasesData = $mikrotikApiService->getDhcpLeasesData($config['ip'], $config['username'], $config['password']);
            } catch (\Exception $e) {
                $dhcpLeasesData = null;
            }
            // Store data in cache for a single retrieval
            Cache::put('dhcpLeasesData', $dhcpLeasesData, 10); // Keep the data for 10 minutes
        }
    }
}
