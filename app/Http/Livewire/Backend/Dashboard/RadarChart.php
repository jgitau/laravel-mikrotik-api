<?php

namespace App\Http\Livewire\Backend\Dashboard;

use App\Helpers\MikrotikConfigHelper;
use App\Services\MikrotikApi\MikrotikApiService;
use Livewire\Component;

class RadarChart extends Component
{
    // TODO: Add the following properties:
    // public function mount(MikrotikApiService $mikrotikApiService)
    // {
    //     // Retrieve the Mikrotik configuration settings.
    //     $config = MikrotikConfigHelper::getMwikrotikConfig();

    //     // Check if the configuration exists and no values are empty.
    //     if ($config && !in_array("", $config, true)) {

    //         // Try to retrieve Mikrotik resource data using Mikrotik API service. On exception, set data to null.
    //         try {
    //             // Retrieve data from Mikrotik router using Mikrotik API Curl service.
    //             $data = $mikrotikApiService->getDhcpLeasesData($config['ip'], $config['username'], $config['password']);
    //         } catch (\Exception $e) {
    //             $data = 0;
    //         }

    //         dd($data);
    //     }
    // }

    public function render()
    {
        return view('livewire.backend.dashboard.radar-chart');
    }
}
