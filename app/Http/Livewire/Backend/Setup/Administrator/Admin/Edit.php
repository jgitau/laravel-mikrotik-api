<?php

namespace App\Http\Livewire\Backend\Setup\Administrator\Admin;

use App\Models\Group;
use App\Services\Admin\AdminService;
use Livewire\Component;

class Edit extends Component
{
    // Properties Public Variables
    public $group_id, $username, $password, $fullname, $email, $status;

    // Groups
    public $groups;

    // Listeners
    protected $listeners = [
        'getAdmin' => 'showAdmin',
    ];

    /**
     *
     * mount
     *
     * @return void
     */
    public function mount()
    {
        // $this->resetFields();
        $this->groups   = Group::orderBy('created_at', 'ASC')->get();
    }

    public function render()
    {
        return view('livewire.backend.setup.administrator.admin.edit');
    }

    /**
     * getAdmin
     *
     * @param  mixed $admin_uid
     * @return void
     */
    public function showAdmin(AdminService $adminService, $admin_uid)
    {
        // Get the admin by uid
        $admin = $adminService->getAdminByUid($admin_uid);

        // Show the modal
        $this->dispatchBrowserEvent('show-modal');

        // Set the public variables
        $this->group_id = $admin['group_id'];
        $this->username = $admin['username'];
        $this->fullname = $admin['fullname'];
        $this->email = $admin['email'];
        $this->status = $admin['status'];
    }

    // TODO: EDIT
    public function updateAdmin()
    {
        dd('TODO:');
    }

    /**
     * closeModal
     *
     * @return void
     */
    public function closeModal()
    {
        $this->dispatchBrowserEvent('hide-modal');
    }

    /**
     * The function resets all fields to their default values.
     */
    public function resetFields()
    {
        $this->group_id = '';
        $this->username = '';
        $this->fullname = '';
        $this->email = '';
        $this->status = '';
    }
}
