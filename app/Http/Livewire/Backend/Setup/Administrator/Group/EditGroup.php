<?php

namespace App\Http\Livewire\Backend\Setup\Administrator\Group;

use App\Services\Group\GroupService;
use Livewire\Component;

class EditGroup extends Component
{
    // Define public variable
    public $groupName, $permission = [];

    // Get Data Group
    public $dataGroup, $groupData, $dataPermissions = [];

    /**
     * Mounts the component and initializes permissions based on group data.
     * @param GroupService $groupService An instance of the GroupService class responsible for handling group-related operations.
     * @param array $dataGroup An array containing group data, including name, members, and permissions.
     */
    public function mount(GroupService $groupService, $dataGroup)
    {
        $this->groupData = $dataGroup['groupData'];
        $this->groupName = $this->groupData->name;
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
}
