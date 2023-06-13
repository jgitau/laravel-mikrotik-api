<?php

namespace App\Http\Livewire\Backend\Dashboard;

use App\Jobs\UpdateMikrotikStats;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ListStatistic extends Component
{
    // These public properties will be available to the Livewire view.
    public $cpuLoad = 0, $activeHotspots = 0, $freeMemoryPercentage = '0%', $uptime = '0d 0:0:0';
    protected $isConnected = false; // Track connection status

    /**
     * The mount method is called when the component is created.
     */
    public function mount()
    {
        // Dispatch the UpdateMikrotikStats job to update the data in cache.
        dispatch(new UpdateMikrotikStats());
        // Attempt to fetch data from cache
        $this->freeMemoryPercentage = Cache::get('mikrotik.freeMemory', 0);
        $this->activeHotspots = Cache::get('mikrotik.activeHotspots', 0);
        $this->cpuLoad = Cache::get('mikrotik.cpuLoad', 0);
        $this->uptime = Cache::get('mikrotik.uptime', '0d 0:0:0');
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
     * This function loads CPU data and uptime from cache and emits events to notify other components
     * of the changes.
     */
    public function loadCpuDataAndUptime()
    {
        // Dispatch the UpdateMikrotikStats job to update the data in cache.
        dispatch(new UpdateMikrotikStats());
        // Load the data from cache
        $this->cpuLoad = Cache::get('mikrotik.cpuLoad', 0);
        $this->uptime = Cache::get('mikrotik.uptime', '0d 0:0:0');
        // Emit events to notify other components of the changes.
        $this->emit('cpuLoadUpdated', $this->cpuLoad);
        $this->emit('uptimeUpdated', $this->uptime);
    }
}
