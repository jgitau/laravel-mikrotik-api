<?php

namespace App\Http\Livewire\Backend\Setup\Administrator\Group;

use App\Models\Group;
use App\Services\Group\GroupService;
use App\Traits\LivewireMessageEvents;
use Livewire\Component;

class CreateGroup extends Component
{
    use LivewireMessageEvents;
    // Define public variable
    public $groupName;

    // DataPermissions
    public $dataPermissions;

    // Permissions
    public $permission = [];

    // Listeners
    protected $listeners = [
        'createdGroup' => '$refresh',
    ];

    // Validation Rules
    protected $rules = [
        'groupName' => 'required|min:4|max:60|unique:groups,name',
        // Add validation rules for the permission
        'permission.*' => 'in:0,1',
    ];

    // Validation Messages
    protected $messages = [
        'groupName.required'    => 'Group Name cannot be empty!',
        'groupName.min'         => 'Group Name must be at least 4 characters!',
        'groupName.max'         => 'Group Name can be a maximum of 60 characters!',
        'groupName.unique'      => 'Group Name already exist!',
        'permission.*.in'       => 'The selected permission is invalid.',
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
     * Mount the component.
     *
     * This function retrieves the current URL redirect setting using GroupService and assigns it to a public variable.
     * @param GroupService $groupService The service to handle configuration related actions.
     */
    public function mount(GroupService $groupService)
    {
        // Get all permissions from the database
        $this->dataPermissions = $groupService->getDataPermissions();

        // Initialize all permissions to 0
        foreach ($this->dataPermissions as $permission) {
            $this->permission[$permission->id] = '0';
        }
    }

    /**
     * render
     */
    public function render()
    {
        return view('livewire.backend.setup.administrator.group.create-group');
    }

    /**
     * Stores a new group, validates the form, resets fields, and emits 'groupCreated' event.
     *
     * @param GroupService $groupService - Service for handling group-related logic.
     * @return redirect - On success, redirects to 'list-groups' route with success message.
     */
    public function storeGroup(GroupService $groupService)
    {
        // Validate Form Request
        $this->validate();

        try {
            // Call the storeNewGroup function in the repository
            $groupService->storeNewGroup($this->groupName, $this->permission);
            // Reset the form fields
            $this->resetFields();
            // Emit the 'groupCreated' event with a true status
            $this->emit('groupCreated', true);
            return redirect()->route('backend.setup.admin.list-groups')->with('success', 'Group was created successfully.');
            // // Redirect to the group.index page with a success message
        } catch (\Throwable $th) {
            // Show Message Error
            $this->dispatchErrorEvent('An error occurred while creating group: ' . $th->getMessage());
        }

    }

    /**
     * resetFields
     *
     * @return void
     */
    public function resetFields()
    {
        $this->groupName = '';
    }
}
