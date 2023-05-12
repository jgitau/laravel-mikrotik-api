<?php

namespace App\Http\Livewire\Backend\Setup\Administrator\Admin;

use App\Models\Group;
use App\Services\Admin\AdminService;
use App\Traits\LivewireMessageEvents;
use Livewire\Component;

class Create extends Component
{
    use LivewireMessageEvents;
    // Properties Public Variables
    public $groupId, $username, $password, $status, $fullName, $emailAddress, $password_confirmation;

    // Groups
    public $groups;

    // Listeners
    protected $listeners = [
        'productCreated' => '$refresh',

    ];

    // Validation Rules
    protected $rules = [
        'groupId'       => 'required',
        'username'      => 'required|min:4|max:60|unique:admins,username',
        'password'      => 'required|min:6|confirmed',
        'status'        => 'required',
        'fullName'      => 'required|min:4|max:100',
        'emailAddress'  => 'required|email|unique:admins,email',
    ];

    // Validation Messages
    protected $messages = [
        'groupId.required'          => 'Choose Group cannot be empty!',
        'username.required'         => 'Username cannot be empty!',
        'username.min'              => 'Username must be at least 4 characters!',
        'username.max'              => 'Username cannot be more than 60 characters!',
        'username.unique'           => 'Username already exists!',
        'password.required'         => 'Password cannot be empty!',
        'password.min'              => 'Password must be at least 6 characters!',
        'password.confirmed'        => 'Password and Confirm Password must match!',
        'status.required'           => 'Status cannot be empty!',
        'fullName.required'         => 'Full Name cannot be empty!',
        'fullName.min'              => 'Full Name must be at least 4 characters!',
        'fullName.max'              => 'Full Name cannot be more than 100 characters!',
        'emailAddress.required'     => 'Email Address cannot be empty!',
        'emailAddress.email'        => 'Email Address must be a valid email address!',
        'emailAddress.unique'       => 'Email Address already exists!',
    ];

    /**
     *
     * mount
     *
     * @return void
     */
    public function mount()
    {
        $this->resetFields();
        $this->groups   = Group::orderBy('created_at', 'ASC')->get();
    }

    /**
     * updated
     *
     * @param  mixed $property
     * @return void
     */
    public function updated($property)
    {
        // Every time a property changes
        // (only `text` for now), validate it
        $this->validateOnly($property);
    }

    public function render()
    {
        return view('livewire.backend.setup.administrator.admin.create');
    }

    /**
     * This function stores a new admin by validating the form, declaring variables, filling an array
     * with public variable values, updating the ads admins, and emitting events.
     *
     * @param AdminService adminService It is an instance of the AdminService class, which is likely
     * responsible for handling the business logic related to creating and managing admin users. It is
     * being passed as a dependency injection to the storeNewAdmin() method.
     */
    public function storeNewAdmin(AdminService $adminService)
    {
        // Validate the form
        $this->validate();

        // Declare the public variable names
        $variables = ['groupId', 'username', 'password', 'status', 'fullName', 'emailAddress',];

        // Declare the settings
        $admins = [];

        // Fill the admins array with public variable values
        foreach ($variables as $variable) {
            $admins[$variable] = $this->$variable;
        }

        try {
            // Store the new admin
            $admin = $adminService->storeNewAdmin($admins);
            if ($admin === null) {
                $this->dispatchErrorEvent('Failed to create the admin');
            }
            // Show Message Success
            $this->dispatchSuccessEvent('Admin was created successfully.');
            // Close the modal
            $this->closeModal();
            // Reset the form fields
            $this->resetFields();
            // Emit the 'adminCreated' event with a true status
            $this->emit('adminCreated', true);
        } catch (\Throwable $th) {
            // Show Message Error
            $this->dispatchErrorEvent('An error occurred while creating admin: ' . $th->getMessage());
            // Close the modal
            $this->closeModal();
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
        $this->groupId = '';
        $this->username = '';
        $this->password = '';
        $this->status = '';
        $this->fullName = '';
        $this->emailAddress = '';
        $this->password_confirmation = '';
    }
}
