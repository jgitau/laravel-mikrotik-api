<?php

namespace App\Http\Livewire\Backend\Setup\Config\Form;

use Livewire\Component;

class UsersData extends Component
{
    public function render()
    {
        return view('livewire.backend.setup.config.form.users-data');
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
