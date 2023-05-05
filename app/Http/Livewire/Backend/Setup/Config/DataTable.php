<?php

namespace App\Http\Livewire\Backend\Setup\Config;

use App\Services\Config\ConfigService;
use Livewire\Component;

class DataTable extends Component
{
    // Listen for the 'nasUpdated' event from other Livewire components
    protected $listeners = [
        'nasUpdated'                => 'handleUpdatedNas',
        'clientUpdated'             => 'handleUpdatedClient',
        'hotelRoomUpdatedUpdated'   => 'handleUpdatedHotelRoom',
        'userDataUpdated'           => 'handleUpdateduserData',
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
     * handleUpdatedNas
     * Called when the 'nasUpdated' event is received
     * Dispatches the 'refreshDatatable' browser event to reload the DataTable
     * @return void
     */
    public function handleUpdatedNas()
    {
        $this->dispatchBrowserEvent('refreshDatatable');
    }

    /**
     * handleUpdatedClient
     * Called when the 'clientUpdated' event is received
     * Dispatches the 'refreshDatatable' browser event to reload the DataTable
     * @return void
     */
    public function handleUpdatedClient()
    {
        $this->dispatchBrowserEvent('refreshDatatable');
    }

    /**
     * handleUpdatedHotelRoom
     * Called when the 'hotelRoomUpdatedUpdated' event is received
     * Dispatches the 'refreshDatatable' browser event to reload the DataTable
     * @return void
     */
    public function handleUpdatedHotelRoom()
    {
        $this->dispatchBrowserEvent('refreshDatatable');
    }

    /**
     * handleUpdateduserData
     * Called when the 'handleUpdateduserData' event is received
     * Dispatches the 'refreshDatatable' browser event to reload the DataTable
     * @return void
     */
    public function handleUpdateduserData()
    {
        $this->dispatchBrowserEvent('refreshDatatable');
    }


}
