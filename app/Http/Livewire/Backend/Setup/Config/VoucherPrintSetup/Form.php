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
        $this->invoice = [
            ['name' => 'Turn on Wifi'],
            ['name' => 'Open internet browser'],
            ['name' => 'Input username password'],
        ];
        // Emit the event with default data
        $this->emit('voucherUpdated', $this->invoice);
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
     * Function to add a new invoice field to the list.=
     */
    public function addInvoiceField()
    {
        // Check if the current count of invoice fields is less than 5
        if (count($this->invoice) < 5) {
            // Add a new invoice field with an empty name
            $this->invoice[] = ['name' => ''];
        } else {
            // Flash an error message indicating the maximum number of fields has been reached
            session()->flash('error', 'Maximum of 5 invoices reached');
        }
    }

    /**
     * Function to remove an invoice field at a specific index.=
     * @param integer $index The index of the field to remove
     */
    public function removeInvoiceField($index)
    {
        // Remove the invoice field at the provided index
        unset($this->invoice[$index]);

        // Reindex the invoice fields to maintain sequential keys
        $this->invoice = array_values($this->invoice);
    }


    /**
     * Validates and updates the voucher.
     */
    public function updateVoucher()
    {
        // Validate the 'invoice' property using the defined validation rules
        $this->validate();
    }

    public function updatedInvoice()
    {
        $this->emit('voucherUpdated', $this->invoice);
    }
}
