<?php

namespace App\Http\Livewire\Backend\Setup\Config\HotelRoom;

use App\Models\Services;
use App\Rules\UniqueCronType;
use App\Services\Config\HotelRoom\HotelRoomService;
use App\Services\ServiceMegalos\ServiceMegalosService;
use App\Traits\LivewireMessageEvents;
use Livewire\Component;

class AddService extends Component
{
    // Use Livewire Message Event
    use LivewireMessageEvents;

    // Properties Public Variables
    public $idService, $cronType;

    // Listeners
    protected $listeners = [
        'serviceCreated' => '$refresh',
    ];

    // Validation Rules
    protected function rules()
    {
        return [
            'idService'   => 'required',
            'cronType'      => ['required', new UniqueCronType],
        ];
    }

    // Custom Message
    protected $messages = [
        'idService.required'  => 'The Service Name cannot be empty.',
        'cronType.required'     => 'The Cron Type cannot be empty.',
    ];

    /**
     * updated
     *
     * @param  mixed $property
     * @return void
     */
    public function updated($property)
    {
        // Every time a property changes
        // (only `text` for now), validate it
        $this->validateOnly($property);
    }

    /**
     * @return The `render()` function is returning a view called `add-service` with an array of
     * `` passed to it. The `` array is obtained by selecting the `service_name`,
     * `cron_type`, and `cron` columns from the `services` table where `cron_type` is not null, `cron`
     * is not an empty string, and `cron` is not equal to
     */
    public function render(ServiceMegalosService $serviceMegalosService)
    {
        $services = $serviceMegalosService->getServices();
        return view('livewire.backend.setup.config.hotel-room.add-service', ['services' => $services]);
    }

    public function storeService(ServiceMegalosService $serviceMegalosService)
    {
        // Validate the form fields
        $this->validate();

        // Declare the public variable names
        $variables = ['idService', 'cronType'];

        // Declare the services
        $services = [];

        // Fill the services array with public variable values
        foreach ($variables as $variable) {
            $services[$variable] = $this->$variable;
        }

        try {
            // Update / Store New Service to Database
            $serviceMegalosService->storeHotelRoomService($services);

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
        $this->idService = '';
        $this->cronType = '';
    }
}
