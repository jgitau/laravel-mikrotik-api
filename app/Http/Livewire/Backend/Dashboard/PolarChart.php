<?php

namespace App\Http\Livewire\Backend\Dashboard;

use App\Jobs\FetchMikrotikDataJob;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class PolarChart extends Component
{
    /**
     * The data to be displayed in the chart.
     */
    public $chartData = ['userActive' => 0, 'ipBindingBypassed' => 0, 'ipBindingBlocked' => 0];

    // Associative array for mapping event listeners to their handling methods.
    protected $listeners = ['getLoadData' => 'loadData'];

    public function updatedChartData()
    {
        $this->emit('chartDataUpdated', $this->chartData);
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
     * Load data from cache or set default data if session is empty.
     */
    public function loadData()
    {
        // Attempt to fetch data from session in Jobs\FetchMikrotikDataJob.php
        dispatch(new FetchMikrotikDataJob());

        // Attempt to fetch data from cache
        $data['userActive'] = intval(Cache::get('userActive', 0));
        $data['ipBindingBypassed'] = intval(Cache::get('ipBindingBypassed', 0));
        $data['ipBindingBlocked'] = intval(Cache::get('ipBindingBlocked', 0));
        // If data exists, save it to chartData. Otherwise, set default data.
        if ($data['userActive'] > 0 || $data['ipBindingBypassed'] > 0 || $data['ipBindingBlocked'] > 0) {
            $this->chartData = $data;
            $this->dispatchBrowserEvent('chartDataUpdated', $this->chartData);
        } else {
            // Send an event to stop polling
            $this->dispatchBrowserEvent('stopGetData');
        }
    }


}
