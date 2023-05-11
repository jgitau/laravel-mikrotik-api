<?php

namespace App\Http\Livewire\Backend\Setup\Administrator\Admin;

use App\Services\Admin\AdminService;
use Livewire\Component;
use Illuminate\Http\Request;

class DataTable extends Component
{

    // Listeners
    protected $listeners = [
        'adminCreated' => 'handleAdminCreated',
    ];

    /**
     * render
     */
    public function render()
    {
        return view('livewire.backend.setup.administrator.admin.data-table');
    }

    /**
     * getDataTable
     * @param  mixed $adminService
     */
    public function getDataTable(AdminService $adminService)
    {
        return $adminService->getDatatables();
    }

    /**
     * handleAdminCreated
     * Called when the 'refreshEditDataTable' event is received
     * Dispatches the 'refreshDatatable' browser event to reload the DataTable
     * @return void
     */
    public function handleAdminCreated()
    {
        $this->dispatchBrowserEvent('refreshDatatable');
    }

}
