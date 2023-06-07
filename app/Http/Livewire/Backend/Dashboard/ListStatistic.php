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
            $data = $mikrotikApiService->getMikrotikResourceData($config['ip'],
                $config['username'],
                $config['password']
            );
        } else {
            // If the config is invalid or incomplete, set default values for data.
            $data = [
                'cpuLoad' => 0,
                'activeHotspot' => 0,
                'freeMemoryPercentage' => '0%',
                'uptime' => '0d 0:0:0'
            ];
        }

        // Assign the fetched data to the public properties.
        $this->cpuLoad = $data['cpuLoad'];
        $this->activeHotspots = $data['activeHotspot'];
        $this->freeMemoryPercentage = $data['freeMemoryPercentage'];
        $this->uptime = $data['uptime'];
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

        // Use the Mikrotik API service to fetch the current router statistics.
        $data = $mikrotikApiService->getMikrotikResourceData($config['ip'], $config['username'], $config['password']);

        // Update the cpuLoad property and emit an event with the updated CPU load.
        $this->cpuLoad = $data['cpuLoad'] ?? 0;
        $this->emit('cpuLoadUpdated', $this->cpuLoad);

        // Update the uptime property and emit an event with the updated uptime.
        $this->uptime = $data['uptime'] ?? '0d 0:0:0';
        $this->emit('uptimeUpdated', $this->uptime);
    }
}
