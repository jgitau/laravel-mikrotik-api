<?php

namespace App\Http\Livewire\Backend\Setup\Administrator\Group;

use App\Services\Group\GroupService;
use Livewire\Component;

class DataTable extends Component
{
    // Define public variable

    // Listeners
    protected $listeners = [
        'groupCreated' => 'handleGroupCreated',
    ];

    /**
     * render
     */
    public function render()
    {
        return view('livewire.backend.setup.administrator.group.data-table');
    }

    /**
     * getDataTable
     * @param  mixed $groupService
     */
    public function getDataTable(GroupService $groupService)
    {
        return $groupService->getDatatables();
    }

    /**
     * handleGroupCreated
     * Called when the 'refreshCreateDataTable' event is received
     * Dispatches the 'refreshDatatable' browser event to reload the DataTable
     * @return void
     */
    public function handleGroupCreated()
    {
        $this->dispatchBrowserEvent('refreshDatatable');
    }
}
