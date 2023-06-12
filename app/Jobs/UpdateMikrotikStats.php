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
use Livewire\Livewire;

class UpdateMikrotikStats implements ShouldQueue
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
     * @param MikrotikApiService $mikrotikApiService The service used for communicating with a Mikrotik router.
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
                $data = $mikrotikApiService->getMikrotikResourceData($config['ip'], $config['username'], $config['password']);
            } catch (\Exception $e) {
                $data = null;
            }

            // Assign the retrieved data to respective variables. Use default values if the data is not available.
            $cpuLoad = $data['cpuLoad'] ?? 0;
            $uptime = $data['uptime'] ?? '0d 0:0:0';
            $freeMemory = $data['freeMemoryPercentage'] ?? '0%';
            $activeHotspots = $data['activeHotspot'] ?? 0;

            // Store data in cache for multiple data retrievals
            Cache::put('mikrotik.cpuLoad', $cpuLoad, 60); // Keep the data for 60 minutes
            Cache::put('mikrotik.uptime', $uptime, 60); // Keep the data for 60 minutes

            // Store data in session for a single retrieval
            session([
                'mikrotik.freeMemory' => $freeMemory,
                'mikrotik.activeHotspots' => $activeHotspots,
            ]);

        }
    }
}
