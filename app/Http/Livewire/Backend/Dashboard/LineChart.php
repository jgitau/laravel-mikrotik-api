<?php

namespace App\Http\Livewire\Backend\Dashboard;

use App\Services\MikrotikApi\MikrotikApiService;
use App\Helpers\MikrotikConfigHelper;
use App\Jobs\UpdateMikrotikTraffic;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class LineChart extends Component
{
    // Arrays for storing upload and download traffic data.
    public $uploadTraffic = 0;
    public $downloadTraffic = 0;

    // Associative array for mapping event listeners to their handling methods.
    protected $listeners = ['getLoadTrafficData' => 'loadTrafficData'];

    /**
     * This method is called when the component is created.
     */
    public function mount()
    {
        // Load traffic data using the provided service.
        $this->uploadTraffic = 0;
        $this->downloadTraffic = 0;
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
     */
    public function loadTrafficData()
    {
        dispatch(new UpdateMikrotikTraffic());
        $this->uploadTraffic = intval(Cache::get('mikrotik.uploadTraffic', 0));
        $this->downloadTraffic = intval(Cache::get('mikrotik.downloadTraffic', 0));

        // Emit an event to update the traffic data.
        $this->emit('updateTrafficData', $this->uploadTraffic, $this->downloadTraffic);
    }
}
