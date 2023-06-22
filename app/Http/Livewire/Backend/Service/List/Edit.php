<?php

namespace App\Http\Livewire\Backend\Service\List;

use Livewire\Component;

class Edit extends Component
{
    /**
     * Handle property updates.
     * @param string $property
     * @return void
     */
    public function updated($property)
    {
        // Every time a property changes, this function will be called
        $this->validateOnly($property);
    }

    /**
     * Render the component `edit form service`.
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backend.service.list.edit');
    }
}
