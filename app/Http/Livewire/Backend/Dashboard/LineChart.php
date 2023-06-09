<?php

namespace App\Http\Livewire\Backend\Dashboard;

use App\Services\MikrotikApi\MikrotikApiService;
use App\Helpers\MikrotikConfigHelper;
use Livewire\Component;

class LineChart extends Component
{
    // Arrays for storing upload and download traffic data.
    public $uploadTraffic = [];
    public $downloadTraffic = [];

    // Associative array for mapping event listeners to their handling methods.
    protected $listeners = ['loadTrafficData' => 'loadTrafficData'];

    /**
     * This method is called when the component is created.
     * @param MikrotikApiService $mikrotikApiService A service for MIKROTIK data retrieval.
     */
    public function mount(MikrotikApiService $mikrotikApiService)
    {
        // Load traffic data using the provided service.
        $this->loadTrafficData($mikrotikApiService);
    }

    /**
     * Render the associated view for this component.
     * @return View The view instance for 'livewire.backend.dashboard.line-chart'.
     */
    public function render()
    {
        // Return the specific view for this component.
        return view('livewire.backend.dashboard.line-chart');
    }

    /**
     * Load traffic data using the provided MikrotikApiService instance.
     * @param MikrotikApiService $mikrotikApiService An instance of MikrotikApiService for MIKROTIK data retrieval.
     */
    public function loadTrafficData(MikrotikApiService $mikrotikApiService)
    {
        // Retrieve MikroTik configuration.
        $config = MikrotikConfigHelper::getMikrotikConfig();

        // Check if the configuration is valid.
        if ($config && !in_array("", $config, true)) {
            // Retrieve traffic data using the MikroTik API service.
            $trafficData = $mikrotikApiService->getTrafficData($config['ip'], $config['username'], $config['password'], env('MIKROTIK_INTERFACE'));
            // dd($trafficData);
            // If traffic data was successfully retrieved, update the component's properties and emit events.
            if ($trafficData) {
                $this->uploadTraffic = $trafficData['uploadTraffic'];
                $this->downloadTraffic = $trafficData['downloadTraffic'];

                // Emit an event to update the traffic data.
                $this->emit('updateTrafficData', $this->uploadTraffic, $this->downloadTraffic);

                // Emit events for updated upload and download traffic.
                $this->emit('uploadTrafficUpdated', $this->uploadTraffic);
                $this->emit('downloadTrafficUpdated', $this->downloadTraffic);
            } else {
                // If traffic data retrieval failed, emit an error event.
                $this->emit('error', 'Failed to fetch traffic data.');
            }
        } else {
            // If the configuration is invalid or incomplete, emit an error event.
            $this->emit('error', 'Invalid or incomplete Mikrotik configuration.');
        }
    }
}
