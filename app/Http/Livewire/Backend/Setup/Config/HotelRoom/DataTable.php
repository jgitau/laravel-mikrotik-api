<?php

namespace App\Http\Livewire\Backend\Setup\Config\HotelRoom;

use App\Services\Config\HotelRoom\HotelRoomService;
use Livewire\Component;

class DataTable extends Component
{

    // Listeners
    protected $listeners = [
        'serviceCreated' => 'handleServiceCreated',
    ];

    /**
     * getDataTable
     * @param  mixed $hotelRoomService
     */
    public function getDataTable(HotelRoomService $hotelRoomService)
    {
        return $hotelRoomService->getDatatables();
    }

    public function render()
    {
        return view('livewire.backend.setup.config.hotel-room.data-table');
    }


    /**
     * handleServiceCreated
     * @return void
     */
    public function handleServiceCreated()
    {
        $this->dispatchBrowserEvent('refreshDatatable');
    }
}
