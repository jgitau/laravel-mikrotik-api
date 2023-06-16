<?php

namespace App\Http\Livewire\Backend\Setup\Config\VoucherPrintSetup;

use App\Traits\LivewireMessageEvents;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;

class LogoForm extends Component
{
    use WithFileUploads;
    use LivewireMessageEvents;

    public $logo;

    protected $rules = [
        'logo' => 'required|image|mimes:jpg,jpeg,png,gif|max:400', // Max size is in kilobytes
    ];

    protected $messages = [
        'logo.required' => 'The logo field is required.',
        'logo.image'    => 'The logo must be an image.',
        'logo.mimes'    => 'The logo must be a file of type: jpg, jpeg, png, gif.',
        'logo.max'      => 'The logo may not be greater than 400 KB.',
    ];

    public function uploadLogo()
    {
        $this->validate();
        try {
            $image = Image::make($this->logo->getRealPath());
            $width = $image->width();
            $height = $image->height();

            if ($width > 80 || $height > 40) {
                $this->dispatchErrorEvent('Logo must be 80x40 pixels. ');
                return;
            }
            // TODO: LOGO UPLOADED

            // Show Success Message
            $this->dispatchSuccessEvent('Logo uploaded successfully.');

            // Reset the form fields
            $this->logo = null;

            // Emit the 'logoUploaded' event with a true status
            $this->emit('logoUploaded', true);
        } catch (\Throwable $th) {
            $this->logo = null;
            // Show Error Message
            $this->dispatchErrorEvent('An error occurred while uploading logo : ' . $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.backend.setup.config.voucher-print-setup.logo-form');
    }
}
