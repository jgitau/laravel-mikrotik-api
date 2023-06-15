<?php

namespace App\Http\Livewire\Backend\Dashboard;

use App\Helpers\MikrotikConfigHelper;
use App\Jobs\UpdateMikrotikStats;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ListStatistic extends Component
{
    // These public properties will be available to the Livewire view.
    public $cpuLoad = 0, $activeHotspots = 0, $freeMemoryPercentage = '0%', $uptime = '0d 0:0:0';
    public $pollingInterval = 2000; // The polling interval in 2 seconds.

    /**
     * The render method returns the view that should be rendered.
     */
    public function render()
    {
        // Render the corresponding view for this component.
        return view('livewire.backend.dashboard.list-statistic');
    }

    /**
     * This function loads CPU, uptime, activeHotspots and freeMemory data from cache and emits events to notify other components
     * of the changes.
     */
    public function loadData()
    {
        $config = MikrotikConfigHelper::getMikrotikConfig();

        // If the configuration is empty, stop polling and return.
        if (empty($config['ip']) || empty($config['username']) || empty($config['password'])) {
            $this->pollingInterval = null; // set polling interval to null and stop polling
            return;
        }
        // Dispatch the UpdateMikrotikStats job to update the data in cache.
        dispatch(new UpdateMikrotikStats());
        // Load the data from cache
        $this->cpuLoad = Cache::get('mikrotik.cpuLoad', 0);
        $this->uptime = Cache::get('mikrotik.uptime', '0d 0:0:0');
        $this->activeHotspots = Cache::get('mikrotik.activeHotspots', 0);
        $this->freeMemoryPercentage = Cache::get('mikrotik.freeMemory', '0%');
    }

}
