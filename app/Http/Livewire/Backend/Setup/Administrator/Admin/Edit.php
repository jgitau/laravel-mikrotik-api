<?php

namespace App\Http\Livewire\Backend\Setup\Administrator\Admin;

use App\Models\Group;
use App\Services\Admin\AdminService;
use App\Traits\LivewireMessageEvents;
use Livewire\Component;

class Edit extends Component
{
    use LivewireMessageEvents;

    // Properties Public Variables
    public $admin_uid, $group_id, $username, $password, $fullname, $email, $status;

    // Groups
    public $groups;

    // Listeners
    protected $listeners = [
        'getAdmin' => 'showAdmin',
        'adminUpdated' => '$refresh',
    ];

    // Validation Rules
    protected function getRules()
    {
        $rules = [
            'group_id'      => 'required',
            'username'      => 'required|min:4|max:60|unique:admins,username,' . $this->admin_uid . ',admin_uid',
            'status'        => 'required',
            'fullname'      => 'required|min:4|max:100',
            'email'         => 'required|email|unique:admins,email,' . $this->admin_uid . ',admin_uid',
        ];
        // If password is not empty
        if (!empty($this->password)) {
            $rules['password'] = 'min:6';
        }
        return $rules;
    }

    // Validation Messages
    protected function getMessages()
    {

        $messages = [
            'group_id.required'         => 'Choose Group cannot be empty!',
            'username.required'         => 'Username cannot be empty!',
            'username.min'              => 'Username must be at least 4 characters!',
            'username.max'              => 'Username cannot be more than 60 characters!',
            'username.unique'           => 'Username already exists!',
            'status.required'           => 'Status cannot be empty!',
            'fullname.required'         => 'Full Name cannot be empty!',
            'fullname.min'              => 'Full Name must be at least 4 characters!',
            'fullname.max'              => 'Full Name cannot be more than 100 characters!',
            'email.required'            => 'Email Address cannot be empty!',
            'email.email'               => 'Email Address must be a valid email address!',
            'email.unique'              => 'Email Address already exists!',
        ];
        // If password is not empty
        if (!empty($this->password)) {
            $messages['password.min'] = 'Password must be at least 6 characters!';
        }
        return $messages;
    }


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
        $this->admin_uid = $admin['admin_uid'];
        $this->group_id = $admin['group_id'];
        $this->username = $admin['username'];
        $this->fullname = $admin['fullname'];
        $this->email = $admin['email'];
        $this->status = $admin['status'];
    }

    /**
     * This function updates an admin's information and dispatches success or error events accordingly.
     * @param AdminService adminService It is an instance of the AdminService class, which is
     * responsible for handling the business logic related to the administration functionality of the
     * application. It is used to update the admin data in the database.
     */
    public function updateAdmin(AdminService $adminService)
    {

        // Validate the data first
        $this->validate($this->getRules(), $this->getMessages());
        // Declare the public variable names
        $variables = ['admin_uid', 'group_id', 'username', 'fullname', 'email', 'status'];
        // Declare the settings
        $dataAdmin = [];

        // Fill the dataAdmin array with public variable values
        foreach ($variables as $variable) {
            $dataAdmin[$variable] = $this->$variable;
        }

        try {
            // Update the admin dataAdmin
            $adminService->updateAdmin($this->admin_uid,$dataAdmin);

            // Show Message Success
            $this->dispatchSuccessEvent('Admin successfully updated.');
            // Emit the 'adminUpdated' event with a true status
            $this->emit('adminUpdated', true);
        } catch (\Throwable $th) {
            // Show Message Error
            $this->dispatchErrorEvent('An error occurred while updating admin: ' . $th->getMessage());
        }

        // Close Modal
        $this->closeModal();
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
        $this->admin_uid = '';
        $this->group_id = '';
        $this->username = '';
        $this->fullname = '';
        $this->email = '';
        $this->status = '';
    }
}
