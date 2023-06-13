<?php

namespace App\Http\Livewire\Backend\Setup\Administrator\Group;

use App\Services\Group\GroupService;
use App\Traits\LivewireMessageEvents;
use Livewire\Component;

class EditGroup extends Component
{
    use LivewireMessageEvents;
    // Define public variable
    public $groupName, $permission = [], $groupId;

    // Get Data Group
    public $dataGroup, $groupData, $dataPermissions = [];

    // Listeners
    protected $listeners = [
        'createdGroup' => '$refresh',
    ];

    // Validation Rules
    protected function getRules()
    {
        return $rules = [
            'groupName' => 'required|min:4|max:60|unique:groups,name,' . $this->groupId . '',
            // Add validation rules for the permission
            'permission.*' => 'in:0,1',
        ];
    }
    // Validation Messages
    protected function getMessages()
    {
        return $messages = [
            'groupName.required'    => 'Group Name cannot be empty!',
            'groupName.min'         => 'Group Name must be at least 4 characters!',
            'groupName.max'         => 'Group Name can be a maximum of 60 characters!',
            'groupName.unique'      => 'Group Name already exist!',
            'permission.*.in'       => 'The selected permission is invalid.',
        ];
    }
    /**
     * Mounts the component and initializes permissions based on group data.
     * @param GroupService $groupService An instance of the GroupService class responsible for handling group-related operations.
     * @param array $dataGroup An array containing group data, including name, members, and permissions.
     */
    public function mount(GroupService $groupService, $dataGroup)
    {
        $this->groupData = $dataGroup['groupData'];
        $this->groupName = $this->groupData->name;
        $this->groupId = $this->groupData->id;
        $this->dataPermissions =  $groupService->getDataPermissions();
        $this->initializePermissions();
    }

    /**
     * The function is called when the user clicks the "Update" button.
     */
    public function render()
    {
        return view('livewire.backend.setup.administrator.group.edit-group');
    }

    public function updateGroup(GroupService $groupService)
    {
        // Validate Form Request
        $this->validate($this->getRules(), $this->getMessages());

        try {
            // Call the storeNewGroup function in the repository
            $groupService->updateGroup($this->groupName, $this->permission, $this->groupId);
            // Reset the form fields
            $this->resetFields();
            // Emit the 'groupUpdated' event with a true status
            $this->emit('groupUpdated', true);
            return redirect()->route('backend.setup.admin.list-groups')->with('success', 'Group was updated successfully.');
            // // Redirect to the group.index page with a success message
        } catch (\Throwable $th) {
            // Show Message Error
            $this->dispatchErrorEvent('An error occurred while updating group: ' . $th->getMessage());
        }
    }

    /**
     * The function initializes all permissions to 0 and sets them to 1 if the group has the
     * permission.
     */
    private function initializePermissions()
    {
        // Initialize all permissions to 0
        foreach ($this->dataPermissions as $permission) {
            // Check if the group has the current permission
            if (in_array($this->groupData->id, explode(',', $permission->allowed_groups))) {
                // If the group has the permission, set it to 1
                $this->permission[$permission->id] = '1';
            } else {
                // If the group doesn't have the permission, set it to 0
                $this->permission[$permission->id] = '0';
            }
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
        $this->groupId = '';
    }
}
