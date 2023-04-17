<?php

namespace App\Http\Livewire\Backend\Setup\Config;

use App\Services\Config\ConfigService;
use Livewire\Component;

class DataTable extends Component
{
    // Listen for the 'nasUpdated' event from other Livewire components
    protected $listeners = [
        'nasUpdated' => 'handleUpdated',
    ];


    public function render()
    {
        return view('livewire.backend.setup.config.data-table');
    }

    /**
     * getDataTable
     * Fetch data for the DataTable using the ConfigService
     * @param  mixed $configService
     */
    public function getDataTable(ConfigService $configService)
    {
        return $configService->getDatatables();
    }

    /**
     * handleUpdated
     * Called when the 'nasUpdated' event is received
     * Dispatches the 'refreshDatatable' browser event to reload the DataTable
     * @return void
     */
    public function handleUpdated()
    {
        $this->dispatchBrowserEvent('refreshDatatable');
    }


}
