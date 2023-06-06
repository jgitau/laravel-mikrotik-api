<?php

namespace App\Http\Livewire\Backend\Dashboard;

use App\Helpers\MikrotikConfigHelper;
use App\Services\Nas\NasService;
use Livewire\Component;

class PolarChart extends Component
{
    public $chartData;

    /**
     * Mounts a NAS service and retrieves data from Mikrotik API for chart population.
     *
     * @param NasService $nasService A service for NAS data retrieval.
     */
    public function mount(NasService $nasService)
    {
        $config = MikrotikConfigHelper::getMikrotikConfig();
        if ($config && !in_array("", $config, true)) {
            $this->chartData = $nasService->getMikrotikUserActive($config['ip'], $config['username'], $config['password']);
        } else {
            $this->chartData = ['userActive' => 0, 'ipBindingBypassed' => 0, 'ipBindingBlocked' => 0];
        }
    }



    public function render()
    {
        return view('livewire.backend.dashboard.polar-chart');
    }
}
