<?php

namespace App\Http\Livewire\Backend\Service\List;

use App\Services\ServiceMegalos\ServiceMegalosService;
use Livewire\Component;

class DataTable extends Component
{
    /**
     * Render the component `data-table`.
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backend.service.list.data-table');
    }

    /**
     * Get data `clients` for the DataTable.
     * @param ServiceMegalosService $serviceMegalosService Client service instance
     * @return mixed
     */
    public function getDataTable(ServiceMegalosService $serviceMegalosService)
    {
        return $serviceMegalosService->getDatatables();
    }
}
