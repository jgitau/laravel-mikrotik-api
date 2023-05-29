<?php

namespace App\Http\Livewire\Backend\Setup\Config\HotelRoom;

use App\Rules\UniqueCronType;
use App\Traits\LivewireMessageEvents;
use Livewire\Component;

class AddService extends Component
{
    // Use Livewire Message Event
    use LivewireMessageEvents;

    // Properties Public Variables
    public $serviceName, $cronType;


    // Validation Rules
    protected function rules()
    {
        return [
            'serviceName'   => 'required',
            'cronType'      => ['required', new UniqueCronType],
        ];
    }

    // Custom Message
    protected $messages = [
        'serviceName.required'  => 'The Service Name cannot be empty.',
        'cronType.required'     => 'The Cron Type cannot be empty.',
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

        // Declare the public variable names
        $variables = ['serviceName', 'cronType'];

        // Declare the services
        $services = [];

        // Fill the services array with public variable values
        foreach ($variables as $variable) {
            $services[$variable] = $this->$variable;
        }

        try {
            // Store the new admin
            // TODO: Add New Service to Database
            // if ($admin === null) {
            //     $this->dispatchErrorEvent('Failed to create the service');
            // }

            // Show Message Success
            $this->dispatchSuccessEvent('Service was created successfully.');
            // Reset the form fields
            $this->resetFields();
            // Emit the 'serviceCreated' event with a true status
            $this->emit('serviceCreated', true);
        } catch (\Throwable $th) {
            // Show Message Error
            $this->dispatchErrorEvent('An error occurred while creating service: ' . $th->getMessage());
        }
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
