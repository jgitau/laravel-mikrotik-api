<?php

namespace App\Http\Livewire\Backend\Setup\Admin;

use App\Services\Admin\AdminService;
use Livewire\Component;
use Illuminate\Http\Request;

class DataTable extends Component
{
    /**
     * render
     */
    public function render()
    {
        return view('livewire.backend.setup.admin.data-table');
    }

    /**
     * getDataTable
     * @param  mixed $adminService
     */
    public function getDataTable(AdminService $adminService)
    {
        return $adminService->getDatatables();
    }
}
