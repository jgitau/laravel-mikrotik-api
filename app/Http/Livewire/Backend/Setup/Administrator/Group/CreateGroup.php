<?php

namespace App\Http\Livewire\Backend\Setup\Administrator\Group;

use App\Models\Group;
use Livewire\Component;

class CreateGroup extends Component
{

    // Define public variable
    public $name,$groupName;

    // Listeners
    protected $listeners = [
        'createdGroup' => '$refresh',
    ];

    // Validation Rules
    protected $rules = [
        'groupName' => 'required|min:4|max:60|unique:groups,name',
    ];

    // Validation Messages
    protected $messages = [
        'groupName.required'    => 'Group Name cannot be empty!',
        'groupName.min'         => 'Group Name must be at least 4 characters!',
        'groupName.max'         => 'Group Name can be a maximum of 60 characters!',
        'groupName.unique'      => 'Group Name already exist!',
    ];
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


    /**
     * render
     */
    public function render()
    {
        return view('livewire.backend.setup.administrator.group.create-group');
    }

    /**
     * store
     *
     * @return void
     */
    public function store()
    {

        // Validate Form Request
        $this->validate();

        try {
            // Create Group
            $group = Group::create([
                'name' => $this->name,
            ]);

            // Set Flash Message
            session()->flash('success', 'Group added successfully!');
            $this->showToast();

            // Reset Form Fields After Creating Group
            $this->resetFields();
            $this->emit('createdGroup', $group);
        } catch (\Exception $e) {
            // Set Flash Message
            session()->flash('error', 'Group failed to add!');

            // Reset Form Fields After Creating Group
            $this->resetFields();
        }
    }

    public function showToast()
    {
        $this->dispatchBrowserEvent('showToast');
    }

    /**
     * resetFields
     *
     * @return void
     */
    public function resetFields()
    {
        $this->name = '';
    }
}
