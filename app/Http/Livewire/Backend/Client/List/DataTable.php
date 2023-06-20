<?php

namespace App\Http\Livewire\Backend\Client\List;

use App\Services\Client\ClientService;
use App\Traits\LivewireMessageEvents;
use Livewire\Component;

class DataTable extends Component
{
    // Import trait for displaying messages from Livewire's events
    use LivewireMessageEvents;

    // Listeners
    protected $listeners = [
        'clientCreated' => 'refreshDataTable',
        'clientUpdated' => 'refreshDataTable',
        'confirmClient' => 'deleteClient',
    ];

    /**
     * Render the component `data-table`.
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backend.client.list.data-table');
    }

    /**
     * Get data `clients` for the DataTable.
     * @param ClientService $clientService Client service instance
     * @return mixed
     */
    public function getDataTable(ClientService $clientService)
    {
        return $clientService->getDatatables();
    }

    /**
     * Refresh the DataTable when an client is created or updated.
     */
    public function refreshDataTable()
    {
        $this->dispatchBrowserEvent('refreshDatatable');
    }
}
