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
    use LivewireMessageEvents;
    // Properties Public Variables
    public $idService, $cronType;

    // Listeners
    protected $listeners = [
        'serviceCreated' => '$refresh',
    ];

    /**
     * Get the validation rules.
     * @return array
     */
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
     * Handle property updates.
     * @param string $property
     * @return void
     */
    public function updated($property)
    {
        // Every time a property changes
        // (only `text` for now), validate it
        $this->validateOnly($property);
    }

    /**
     * Render the component.
     * @param ServiceMegalosService $serviceMegalosService
     * @return \Illuminate\View\View
     */
    public function render(ServiceMegalosService $serviceMegalosService)
    {
        // Get services from the database
        $services = $serviceMegalosService->getServices();
        return view('livewire.backend.setup.config.hotel-room.add-service', ['services' => $services]);
    }

    /**
     * Store a new service.
     * @param ServiceMegalosService $serviceMegalosService
     * @return void
     */
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

            // Show Success Message
            $this->dispatchSuccessEvent('Service was created successfully.');

            // Reset the form fields
            $this->resetFields();

            // Emit the 'serviceCreated' event with a true status
            $this->emit('serviceCreated', true);
        } catch (\Throwable $th) {
            // Show Error Message
            $this->dispatchErrorEvent('An error occurred while creating service: ' . $th->getMessage());
        }
    }

    /**
     * Reset the form fields.
     * @return void
     */
    public function resetFields()
    {
        $this->idService = '';
        $this->cronType = '';
    }
}
