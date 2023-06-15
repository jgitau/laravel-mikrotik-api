<?php

namespace App\Http\Livewire\Backend\Setup\Config\VoucherPrintSetup;

use Livewire\Component;

class View extends Component
{
    // Public property for storing invoice instructions
    public $invoice = [
        ['name' => 'Turn on Wifi'],
        ['name' => 'Open internet browser'],
        ['name' => 'Input username password'],
    ];

    // Other properties
    public $vouchers_type = 'with_password'; // Update this as needed
    public $username = 'username'; // Update this as needed
    public $password = 'password'; // Update this as needed
    public $access_code = 'access_code'; // Update this as needed
    public $valid_until = '10 Feb 2027'; // Update this as needed
    public $time_limit = '2 Hours'; // Update this as needed
    public $serial_number = 'MGL00000001'; // Update this as needed

    // Event listener
    protected $listeners = ['voucherUpdated' => 'onVoucherUpdated'];

    /**
     * Update the invoice data when the 'voucherUpdated' event is emitted
     * @param  array  $invoice  The updated invoice data
     * @return void
     */
    public function onVoucherUpdated($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Render the view for the component.
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        return view('livewire.backend.setup.config.voucher-print-setup.view');
    }
}
