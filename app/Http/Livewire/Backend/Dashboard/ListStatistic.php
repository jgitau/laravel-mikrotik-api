<?php

namespace App\Http\Livewire\Backend\Dashboard;

use App\Helpers\MikrotikConfigHelper;
use App\Services\MikrotikApi\MikrotikApiService;
use Livewire\Component;

class ListStatistic extends Component
{
    // These public properties will be available to the Livewire view.
    public $cpuLoad, $activeHotspots, $freeMemoryPercentage, $uptime;

    /**
     * The mount method is called when the component is created.
     * @param MikrotikApiService $mikrotikApiService A service for MIKROTIK data retrieval.
     */
    public function mount(MikrotikApiService $mikrotikApiService)
    {
        // Retrieve the Mikrotik configuration settings.
        $config = MikrotikConfigHelper::getMikrotikConfig();

        // Check if the configuration exists and no values are empty.
        if ($config && !in_array("", $config, true)) {
            // Use the Mikrotik API service to fetch the current router statistics.
            try {
                $data = $mikrotikApiService->getMikrotikResourceData($config['ip'], $config['username'], $config['password']);
            } catch (\Exception $e) {
                // On error, set $data to null.
                $data = null;
            }
        } else {
            // If the config is invalid or incomplete, set $data to null.
            $data = null;
        }

        // If data was fetched successfully, assign it to the public properties.
        $this->cpuLoad = $data['cpuLoad'] ?? 0;
        $this->activeHotspots = $data['activeHotspot'] ?? 0;
        $this->freeMemoryPercentage = $data['freeMemoryPercentage'] ?? '0%';
        $this->uptime = $data['uptime'] ?? '0d 0:0:0';
    }

    /**
     * The render method returns the view that should be rendered.
     */
    public function render()
    {
        // Render the corresponding view for this component.
        return view('livewire.backend.dashboard.list-statistic');
    }

    /**
     * The loadCpuDataAndUptime method updates the cpuLoad and uptime properties
     * and emits events to notify other components of these changes.
     * @param MikrotikApiService $mikrotikApiService The service used for communicating with a Mikrotik router.
     */
    public function loadCpuDataAndUptime(MikrotikApiService $mikrotikApiService)
    {
        // Retrieve the Mikrotik configuration settings.
        $config = MikrotikConfigHelper::getMikrotikConfig();

        if ($config && !in_array("", $config, true)) {
            // Use the Mikrotik API service to fetch the current router statistics.
            try {
                $data = $mikrotikApiService->getMikrotikResourceData($config['ip'], $config['username'], $config['password']);
            } catch (\Exception $e) {
                // Emit an error message if the API call fails.
                $this->emit('error', 'Failed to fetch Mikrotik data: ' . $e->getMessage());
                return;
            }

            if ($data !== null) {
                // If data is available, assign it to the corresponding properties.
                $this->cpuLoad = $data['cpuLoad'];
                $this->uptime = $data['uptime'];

                // Emit events to notify other components of the updated data.
                $this->emit('cpuLoadUpdated', $this->cpuLoad);
                $this->emit('uptimeUpdated', $this->uptime);
            }
        } else {
            // If the configuration is not available or incomplete, emit an error message.
            $this->emit('error', 'Invalid or incomplete Mikrotik configuration.');
        }
    }


}
