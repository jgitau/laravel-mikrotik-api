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
     * Get the data for the data table.
     * @param HotelRoomService $hotelRoomService
     * @return mixed
     */
    public function getDataTable(HotelRoomService $hotelRoomService)
    {
        return $hotelRoomService->getDatatables();
    }

    /**
     * Render the component.
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backend.setup.config.hotel-room.data-table');
    }

    /**
     * Handle the 'serviceCreated' event.
     * @return void
     */
    public function handleServiceCreated()
    {
        $this->dispatchBrowserEvent('refreshDatatable');
    }

    /**
     * Delete a service.
     * @param ServiceMegalosService $serviceMegalosService
     * @param int $id
     * @return void
     */
    public function deleteService(ServiceMegalosService $serviceMegalosService, $id)
    {
        try {
            // Delete Service by Id
            $serviceMegalosService->deleteService($id);

            // Show Success Message
            $this->dispatchSuccessEvent('Service successfully deleted.');

            // Dispatch the 'refreshDatatable' event to refresh the datatable
            $this->dispatchBrowserEvent('refreshDatatable');
        } catch (\Throwable $th) {
            // Show Error Message
            $this->dispatchErrorEvent('An error occurred while deleting service: ' . $th->getMessage());
        }
    }
}
