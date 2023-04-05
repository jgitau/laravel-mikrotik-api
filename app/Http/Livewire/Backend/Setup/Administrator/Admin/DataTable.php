<?php

namespace App\Http\Livewire\Backend\Setup\Administrator\Admin;

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
}
