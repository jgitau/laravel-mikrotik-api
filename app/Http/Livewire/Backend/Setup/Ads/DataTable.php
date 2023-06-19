<?php

namespace App\Http\Livewire\Backend\Setup\Ads;

use App\Services\Config\Ads\AdsService;
use Livewire\Component;

class DataTable extends Component
{
    // Listeners
    protected $listeners = [
        'adCreated' => 'handleAdCreated',
    ];

    /**
     * Render the component `data-table`.
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backend.setup.ads.data-table');
    }

    /**
     * getDataTable
     * @param  mixed $adsService
     */
    public function getDataTable(AdsService $adsService)
    {
        return $adsService->getDatatables();
    }

    /**
     * handleAdCreated
     * Called when the 'refreshCreateDataTable' event is received
     * Dispatches the 'refreshDatatable' browser event to reload the DataTable
     * @return void
     */
    public function handleAdCreated()
    {
        $this->dispatchBrowserEvent('refreshDatatable');
    }
}
