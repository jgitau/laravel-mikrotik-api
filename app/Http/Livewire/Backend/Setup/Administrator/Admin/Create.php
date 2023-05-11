<?php

namespace App\Http\Livewire\Backend\Setup\Administrator\Admin;

use App\Models\Group;
use Livewire\Component;

class Create extends Component
{
    // Properties Public Variables
    public $chooseGroup, $username, $password, $status, $fullName, $emailAddress, $password_confirmation;

    // Groups
    public $groups;

    // Validation Rules
    protected $rules = [
        'chooseGroup'   => 'required',
        'username'      => 'required|min:4|max:60|unique:admins,username',
        'password'      => 'required|min:6|confirmed',
        'status'        => 'required',
        'fullName'      => 'required|min:4|max:100',
        'emailAddress'  => 'required|email|unique:admins,email',
    ];

    // Validation Messages
    protected $messages = [
        'chooseGroup.required'      => 'Choose Group cannot be empty!',
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

    // TODO:
    public function storeNewAdmin()
    {
        $this->validate();
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

    public function resetFields()
    {
        $this->chooseGroup = '';
        $this->username = '';
        $this->password = '';
        $this->status = '';
        $this->fullName = '';
        $this->emailAddress = '';
        $this->password_confirmation = '';
    }
}
