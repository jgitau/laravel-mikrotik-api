<?php

namespace App\Http\Livewire\Backend\Dashboard;

use App\Helpers\MikrotikConfigHelper;
use App\Jobs\FetchMikrotikDataJob;
use App\Services\MikrotikApi\MikrotikApiService;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class PolarChart extends Component
{

    /**
     * The data to be displayed in the chart.
     */
    public $chartData;

    /**
     * Component mount lifecycle hook.
     * Fetches and prepares data for the chart.
     */
    public function mount()
    {
        // Prepare data for the chart
        $this->chartData = $this->prepareChartData();

        // Load the prepared data
        $this->loadData();
    }

    /**
     * Render the Polar Chart view.
     * @return \Illuminate\View\View The Polar Chart view.
     */
    public function render()
    {
        return view('livewire.backend.dashboard.polar-chart');
    }

    /**
     * Load data from session or set default data if session is empty.
     */
    public function loadData()
    {
        // Attempt to fetch data from session
        $data = session('mikrotik_data');

        // If data exists, save it to chartData. Otherwise, set default data.
        $this->chartData = $data ?? $this->setDefaultChartData();
    }

    /**
     * Set default chart data.
     * @return array The default chart data.
     */
    private function setDefaultChartData()
    {
        return ['userActive' => 0, 'ipBindingBypassed' => 0, 'ipBindingBlocked' => 0];
    }

    /**
     * Prepare chart data.
     * Retrieves Mikrotik configuration, dispatches a job to fetch active user data,
     * and returns default data if the configuration is invalid.
     * @return array The prepared chart data.
     */
    private function prepareChartData()
    {
        // Retrieve the Mikrotik configuration settings
        $config = MikrotikConfigHelper::getMikrotikConfig();

        // If configuration exists and is complete, dispatch a job to fetch data
        if ($config && !in_array("", $config, true)) {
            FetchMikrotikDataJob::dispatch($config['ip'], $config['username'], $config['password']);
        }

        // Return default chart data (as the fetched data is saved to cache, not directly returned)
        return $this->setDefaultChartData();
    }
}
