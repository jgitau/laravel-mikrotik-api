<?php

namespace App\Http\Livewire\Backend\Setup\Config\Form;

use Livewire\Component;

class ModalManager extends Component
{
    // Livewire listeners for modal events
    protected $listeners = [
        'showModal' => 'showModal',
        'closeModal' => 'closeModal',
    ];

    // Declare Public Variables
    public $livewireComponentName = '';

    /**
     * Renders the modal-manager view.
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backend.setup.config.form.modal-manager');
    }

    /**
     * Shows the modal window with the specified Livewire component.
     * @param  mixed $livewireComponentName
     * @return void
     */
    public function showModal($livewireComponentName)
    {
        $this->livewireComponentName = $livewireComponentName;

        $this->dispatchBrowserEvent('show-modal', ['livewireComponentName' => $livewireComponentName]);
    }

    /**
     * Closes the modal window.
     * @return void
     */
    public function closeModal()
    {
        $this->livewireComponentName = '';

        $this->dispatchBrowserEvent('hide-modal');
    }

}
