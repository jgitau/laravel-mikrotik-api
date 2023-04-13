<?php

namespace App\Http\Livewire\Backend\Setup\Config\Form;

use Livewire\Component;

class HotelRooms extends Component
{
    public function render()
    {
        return view('livewire.backend.setup.config.form.hotel-rooms');
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
