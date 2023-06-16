<?php

namespace App\Http\Livewire\Backend\Setup\Config\VoucherPrintSetup;

use App\Services\Setting\SettingService;
use Livewire\Component;

class View extends Component
{
    // Public property for storing invoice instructions
    public $invoice = [];

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
     * Initializes the component.
     * Retrieves the setting 'how_to_use_voucher' using SettingService and sets up the 'invoice' property.
     * @param SettingService $settingService The service used for retrieving application settings.
     * @return void
     */
    public function mount(SettingService $settingService)
    {
        $howToUse = $settingService->getSetting('how_to_use_voucher', 3);

        // Explode the string into an array based on comma
        $howToUseArray = explode(',', $howToUse);

        // Map the array into the desired format for invoice
        $this->invoice = array_map(function ($item) {
            return ['name' => $item];
        }, $howToUseArray);
    }

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
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backend.setup.config.voucher-print-setup.view');
    }
}
