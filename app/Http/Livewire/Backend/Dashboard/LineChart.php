<?php

namespace App\Http\Livewire\Backend\Dashboard;

use App\Helpers\MikrotikConfigHelper;
use App\Services\MikrotikApi\MikrotikApiService;
use Livewire\Component;

class LineChart extends Component
{
    public $uploadTraffic, $downloadTraffic;

    protected $listeners = ['callLoadTrafficData' => 'loadTrafficData'];

    public function mount(MikrotikApiService $mikrotikApiService)
    {
        // Retrieve the Mikrotik configuration settings.
        $config = MikrotikConfigHelper::getMikrotikConfig();

        if ($config && !in_array("", $config, true)) {
            // Use the Mikrotik API service to fetch the current traffic data.
            $data = $mikrotikApiService->getTrafficData($config['ip'], $config['username'], $config['password'], 'ether2-wan');
        } else {
            // If the config is invalid or incomplete, set default values for data.
            $data = [
                'uploadTraffic' => 0,
                'downloadTraffic' => 0
            ];

            // Emit an error event
            $this->emit('error', 'Invalid or incomplete Mikrotik configuration.');
            return;
        }

        // Update the uploadTraffic and downloadTraffic properties.
        $this->uploadTraffic = $data['uploadTraffic'];
        $this->downloadTraffic = $data['downloadTraffic'];
    }

    public function render()
    {
        return view('livewire.backend.dashboard.line-chart');
    }

    /**
     * Loads traffic data from the specified network interface of a Mikrotik device.
     * @param MikrotikApiService $mikrotikApiService The service used for communicating with a Mikrotik router.
     * @param string $interface Network interface to monitor.
     */
    public function loadTrafficData(MikrotikApiService $mikrotikApiService)
    {
        $config = MikrotikConfigHelper::getMikrotikConfig();
        if ($config && !in_array("", $config, true)) {
            $data = $mikrotikApiService->getTrafficData($config['ip'], $config['username'], $config['password'], 'ether2-wan');
        } else {
            $data = [
                'uploadTraffic' => 0,
                'downloadTraffic' => 0
            ];
            $this->emit('error', 'Invalid or incomplete Mikrotik configuration.');
            return;
        }
        $this->uploadTraffic = $data['uploadTraffic'];
        $this->downloadTraffic = $data['downloadTraffic'];

        // Emit events with the updated traffic data.
        $this->emit('uploadTrafficUpdated', $this->uploadTraffic);
        $this->emit('downloadTrafficUpdated', $this->downloadTraffic);
    }
}
