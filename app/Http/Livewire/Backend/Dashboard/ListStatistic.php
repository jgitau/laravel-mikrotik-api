<?php

namespace App\Http\Livewire\Backend\Dashboard;

use App\Helpers\MikrotikConfigHelper;
use App\Services\MikrotikApi\MikrotikApiService;
use Livewire\Component;

class ListStatistic extends Component
{
    // Set public properties for data
    public $cpuLoad, $activeHotspots, $freeMemoryPercentage, $uptime;

    /**
     * Mounts a MIKROTIK service and retrieves data from Mikrotik API for chart population.
     * @param MikrotikApiService $mikrotikApiService A service for NAS data retrieval.
     */
    public function mount(MikrotikApiService $mikrotikApiService)
    {
        // Just to initiate the property with an initial value, the update will be done in the view.
        $this->cpuLoad = 0;
        $this->activeHotspots = $this->prepareActiveHotspots($mikrotikApiService);
        $this->freeMemoryPercentage = $this->prepareFreeMemoryPercentage($mikrotikApiService);
        $this->uptime = $this->prepareUptime($mikrotikApiService);
    }

    /**
     * This function returns a view for a polar chart in a backend dashboard.
     */
    public function render()
    {
        return view('livewire.backend.dashboard.list-statistic');
    }

    /**
     * Loads and prepares CPU data using a Mikrotik API service.
     * @param MikrotikApiService $mikrotikApiService The service used for communicating with a Mikrotik router.
     */
    public function loadCpuData(MikrotikApiService $mikrotikApiService)
    {
        $this->cpuLoad = $this->prepareCpuLoad($mikrotikApiService);


        // Emit an event with the updated CPU load
        $this->emit('cpuLoadUpdated', $this->cpuLoad);
    }

    /**
     * Retrieves Mikrotik configuration, validates it, and gets active user data from Mikrotik
     * or default data if configuration is invalid.
     * @param MikrotikApiService $mikrotikApiService MIKROTIK service for data retrieval.
     * @return array Returns array with user data or default values.
     */
    private function prepareCpuLoad(MikrotikApiService $mikrotikApiService)
    {
        // Retrieve the Mikrotik configuration settings from the helper.
        $config = MikrotikConfigHelper::getMikrotikConfig();

        // Check if the configuration exists and no values are empty.
        if ($config && !in_array("", $config, true)) {
            // If the config is valid, retrieve the Mikrotik user active data.
            return $mikrotikApiService->getMikrotikCpuLoad($config['ip'], $config['username'], $config['password']);
        } else {
            // If the config is invalid or incomplete, set default values for chart data.
            return 0;
        }
    }

    /**
     * Retrieves Mikrotik configuration, validates it, and gets active hotspot data from Mikrotik
     * or default data if configuration is invalid.
     * @param MikrotikApiService $mikrotikApiService MIKROTIK service for data retrieval.
     * @return array Returns array with user data or default values.
     */
    private function prepareActiveHotspots(MikrotikApiService $mikrotikApiService)
    {
        // Retrieve the Mikrotik configuration settings from the helper.
        $config = MikrotikConfigHelper::getMikrotikConfig();

        // Check if the configuration exists and no values are empty.
        if ($config && !in_array("", $config, true)) {
            // If the config is valid, retrieve the Mikrotik active hotspot data.
            return $mikrotikApiService->getMikrotikActiveHotspot($config['ip'], $config['username'], $config['password']);
        } else {
            // If the config is invalid or incomplete, set default values for chart data.
            return 0;
        }
    }

    /**
     * Retrieves Mikrotik configuration, validates it, and gets free memory percentage data from Mikrotik
     * or default data if configuration is invalid.
     * @param MikrotikApiService $mikrotikApiService MIKROTIK service for data retrieval.
     * @return array Returns array with user data or default values.
     */
    private function prepareFreeMemoryPercentage(MikrotikApiService $mikrotikApiService)
    {
        // Retrieve the Mikrotik configuration settings from the helper.
        $config = MikrotikConfigHelper::getMikrotikConfig();

        // Check if the configuration exists and no values are empty.
        if ($config && !in_array("", $config, true)) {
            // If the config is valid, retrieve the Mikrotik free memory percentage data.
            return $mikrotikApiService->getMikrotikFreeMemoryPercentage($config['ip'], $config['username'], $config['password']);
        } else {
            // If the config is invalid or incomplete, set default values for chart data.
            return '0%';
        }
    }

    /**
     * Prepares uptime data using a Mikrotik API service.
     * @param MikrotikApiService $mikrotikApiService Instance for Mikrotik API communication.
     * @return string Uptime if valid config, else '0d 0:0:0'.
     */
    private function prepareUptime(MikrotikApiService $mikrotikApiService)
    {
        // Retrieve the Mikrotik configuration settings from the helper
        $config = MikrotikConfigHelper::getMikrotikConfig();

        // Check if the configuration exists and no values are empty.
        if ($config && !in_array("", $config, true)) {
            // If the config is valid, retrieve the Mikrotik uptime data.
            return $mikrotikApiService->getMikrotikUptime($config['ip'], $config['username'], $config['password']);
        } else {
            // If the config is invalid or incomplete, set default values for chart data.
            return '0d 0:0:0';
        }
    }
}
