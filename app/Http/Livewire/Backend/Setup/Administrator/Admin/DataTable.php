<?php

namespace App\Http\Livewire\Backend\Setup\Administrator\Admin;

use App\Services\Admin\AdminService;
use App\Traits\LivewireMessageEvents;
use Livewire\Component;
use Illuminate\Http\Request;

class DataTable extends Component
{
    use LivewireMessageEvents;
    // Properties public $admin_uid;
    public $admin_uid;

    // Listeners
    protected $listeners = [
        'adminCreated' => 'handleAdminCreated',
        'adminUpdated' => 'handleAdminUpdated',
        'confirmAdmin' => 'deleteAdmin',
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
     * Called when the 'refreshCreateDataTable' event is received
     * Dispatches the 'refreshDatatable' browser event to reload the DataTable
     * @return void
     */
    public function handleAdminCreated()
    {
        $this->dispatchBrowserEvent('refreshDatatable');
    }

    /**
     * handleAdminUpdated
     * Called when the 'refreshEditDataTable' event is received
     * Dispatches the 'refreshDatatable' browser event to reload the DataTable
     * @return void
     */
    public function handleAdminUpdated()
    {
        $this->dispatchBrowserEvent('refreshDatatable');
    }

    /**
     * This PHP function deletes an admin using an AdminService and dispatches success or error events
     * accordingly.
     * @param AdminService adminService It is an instance of the AdminService class, which is
     * responsible for handling the business logic related to the administration functionality of the
     * application.
     * @param admin_uid The unique identifier of the admin that needs to be deleted.
     */
    public function deleteAdmin(AdminService $adminService ,$admin_uid)
    {
        try {
            // Delete Admin by uid
            $adminService->deleteAdmin($admin_uid);
            // Show Message Success
            $this->dispatchSuccessEvent('Admin successfully deleted.');
            // Dispatchs the 'adminDeleted' event with a true status
            $this->dispatchBrowserEvent('refreshDatatable');
        } catch (\Throwable $th) {
            // Show Message Error
            $this->dispatchErrorEvent('An error occurred while deleting admin: ' . $th->getMessage());

        }
    }

}
