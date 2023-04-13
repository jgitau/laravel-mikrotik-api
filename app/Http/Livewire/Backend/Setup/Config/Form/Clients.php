<?php

namespace App\Http\Livewire\Backend\Setup\Config\Form;

use Livewire\Component;

class Clients extends Component
{
    public function render()
    {
        return view('livewire.backend.setup.config.form.clients');
    }

    /**
     * closeModal
     *
     * @return void
     */
    public function closeModal()
    {
        $this->emit('closeModal');
    }
}
