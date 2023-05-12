<?php

namespace App\Http\Livewire\Backend\Setup\Config\HotelRoom;

use Livewire\Component;

class AddService extends Component
{
    // Properties Public Variables
    public $serviceName, $cronType;


    // Validation Rules
    protected $rules = [
        'serviceName'   => 'required|unique:services,service_name',
        'cronType'      => 'required',
    ];

    // Custom Message
    protected $messages = [
        'serviceName.required'  => 'The Service Name cannot be empty.',
        'cronType.required'     => 'The Cron Type cannot be empty.',
        'serviceName.unique'    => 'The Services Name already exist.',
    ];


    /**
     * @return The `render()` function is returning a view named `add-service.blade.php` located in the
     * directory `livewire/backend/setup/config/hotel-room/`.
     */
    public function render()
    {
        return view('livewire.backend.setup.config.hotel-room.add-service');
    }

    public function storeService()
    {
        // Validate the form fields
        $this->validate();

        // TODO: Add New Service to Database
    }

    /**
     * This function resets the values of two variables to empty strings.
     */
    public function resetFields()
    {
        $this->serviceName = '';
        $this->cronType = '';
    }

}
