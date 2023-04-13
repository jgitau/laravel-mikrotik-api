<?php

namespace App\Http\Livewire\Backend\Setup\Config\Form;

use Livewire\Component;

class SocialPlugins extends Component
{
    public function render()
    {
        return view('livewire.backend.setup.config.form.social-plugins');
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
