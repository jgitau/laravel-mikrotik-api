<?php

namespace App\Http\Livewire\Backend\Setup\Config\HotelRoom;

use App\Services\Config\HotelRoom\HotelRoomService;
use App\Services\ServiceMegalos\ServiceMegalosService;
use App\Traits\LivewireMessageEvents;
use Livewire\Component;

class DataTable extends Component
{
    // Use Livewire Event Message
    use LivewireMessageEvents;

    // Listeners
    protected $listeners = [
        'serviceCreated' => 'handleServiceCreated',
        'confirmService' => 'deleteService',
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

    public function deleteService(ServiceMegalosService $serviceMegalosService, $id)
    {
        try {
            // Delete Service by Id
            $serviceMegalosService->deleteService($id);
            // Show Message Success
            $this->dispatchSuccessEvent('Service successfully deleted.');
            // Dispatchs the 'serviceDeleted' event with a true status
            $this->dispatchBrowserEvent('refreshDatatable');
        } catch (\Throwable $th) {
            // Show Message Error
            $this->dispatchErrorEvent('An error occurred while deleting service: ' . $th->getMessage());
        }
    }
}
