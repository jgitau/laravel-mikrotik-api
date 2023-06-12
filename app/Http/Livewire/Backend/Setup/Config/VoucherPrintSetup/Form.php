<?php

namespace App\Http\Livewire\Backend\Setup\Config\VoucherPrintSetup;

use Livewire\Component;

class Form extends Component
{
    public $invoice = [];

    public function mount()
    {
        $this->invoice = [
            ['name' => 'Turn on Wifi'],
            ['name' => 'Open internet browser'],
            ['name' => 'Input username password'],
        ];
    }

    protected $rules = [
        'invoice.*.name' => ['required', 'string'],
    ];

    public function render()
    {
        return view('livewire.backend.setup.config.voucher-print-setup.form');
    }

    public function updateVoucher()
    {
        $this->validate();
    }
}
