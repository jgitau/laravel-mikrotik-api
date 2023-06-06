<?php

namespace App\Http\Livewire\Backend\Dashboard;

use App\Helpers\MikrotikConfigHelper;
use App\Services\MikrotikApi\MikrotikApiService;
use Livewire\Component;

class PolarChart extends Component
{

    // Set public properties for chart data
    public $chartData;

    /**
     * Mounts a MIKROTIK service and retrieves data from Mikrotik API for chart population.
     * @param MikrotikApiService $mikrotikApiService A service for NAS data retrieval.
     */
    public function mount(MikrotikApiService $mikrotikApiService)
    {
        // Retrieve the Mikrotik configuration settings from the helper.
        $this->chartData = $this->prepareChartData($mikrotikApiService);
    }

    /**
     * This function returns a view for a polar chart in a backend dashboard.
     */
    public function render()
    {
        return view('livewire.backend.dashboard.polar-chart');
    }

    /**
     * Retrieves Mikrotik configuration, validates it, and gets active user data from Mikrotik
     * or default data if configuration is invalid.
     * @param MikrotikApiService $mikrotikApiService MIKROTIK service for data retrieval.
     * @return array Returns array with user data or default values.
     */
    private function prepareChartData(MikrotikApiService $mikrotikApiService)
    {
        // Retrieve the Mikrotik configuration settings from the helper.
        $config = MikrotikConfigHelper::getMikrotikConfig();

        // Check if the configuration exists and no values are empty.
        if ($config && !in_array("", $config, true)) {
            // If the config is valid, retrieve the Mikrotik user active data.
            return $mikrotikApiService->getMikrotikUserActive($config['ip'], $config['username'], $config['password']);
        } else {
            // If the config is invalid or incomplete, set default values for chart data.
            return ['userActive' => 0, 'ipBindingBypassed' => 0, 'ipBindingBlocked' => 0];
        }
    }
}
