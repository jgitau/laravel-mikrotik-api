<?php

namespace App\Http\Livewire\Backend\Setup\Config\VoucherPrintSetup;

use Livewire\Component;

class Form extends Component
{
    // Public property for storing invoice instructions
    public $invoice = [];

    /**
     * Initialization lifecycle hook of Livewire component.
     */
    public function mount()
    {
        // Populate the invoice array with default instructions
        $this->invoice = [
            ['name' => 'Turn on Wifi'],
            ['name' => 'Open internet browser'],
            ['name' => 'Input username password'],
        ];
    }

    // Validation rules for the invoice property
    protected $rules = [
        // Each item in the invoice array must have a 'name' property that is required and a string
        'invoice.*.name' => ['required', 'string'],
    ];

    /**
     * Renders the component's view.
     * @return \Illuminate\View\View The view of the component
     */
    public function render()
    {
        return view('livewire.backend.setup.config.voucher-print-setup.form');
    }

    /**
     * Validates and updates the voucher.
     */
    public function updateVoucher()
    {
        // Validate the 'invoice' property using the defined validation rules
        $this->validate();
    }
}
