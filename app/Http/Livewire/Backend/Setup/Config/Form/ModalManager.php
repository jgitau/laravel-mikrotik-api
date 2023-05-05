<?php

namespace App\Http\Livewire\Backend\Setup\Config\Form;

use Livewire\Component;

class ModalManager extends Component
{
    protected $listeners = [
        'showModal' => 'showModal',
        'closeModal' => 'closeModal',
    ];

    public $livewireComponentName = '';

    /**
     * render
     */
    public function render()
    {
        return view('livewire.backend.setup.config.form.modal-manager');
    }

    /**
     * showModal
     *
     * @param  mixed $livewireComponentName
     * @return void
     */
    public function showModal($livewireComponentName)
    {
        $this->livewireComponentName = $livewireComponentName;

        $this->dispatchBrowserEvent('show-modal', ['livewireComponentName' => $livewireComponentName]);
    }

    /**
     * closeModal
     *
     * @return void
     */
    public function closeModal()
    {
        $this->livewireComponentName = '';

        $this->dispatchBrowserEvent('hide-modal');
    }
}
