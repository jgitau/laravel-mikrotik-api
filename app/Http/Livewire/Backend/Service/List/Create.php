<?php

namespace App\Http\Livewire\Backend\Service\List;

use App\Services\ServiceMegalos\ServiceMegalosService;
use App\Traits\LivewireMessageEvents;
use Livewire\Component;

class Create extends Component
{
    // Traits LivewireMessageEvents for show modal and toast message
    use LivewireMessageEvents;
    // Define public variables

    // Listeners for refresh component
    protected $listeners = [
        'createdService' => '$refresh',
    ];

    /**
     * Handle property updates.
     * @param string $property
     * @return void
     */
    public function updated($property)
    {
        // Every time a property changes, this function will be called
        $this->validateOnly($property);
    }

    /**
     * Render the component `create new service form`.
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backend.service.list.create');
    }

    /**
     * Stores a new service, validates the form, resets fields, and emits 'serviceCreated' event.
     * @param ServiceMegalosService $serviceMegalosService - Service for handling service-related logic.
     * @return redirect - On success, redirects to 'list-services' route with success message.
     */
    public function storeService(ServiceMegalosService $serviceMegalosService)
    {
        // Validate Form Request
        $this->validate();

        try {
            // Call the storeNewService function in the repository
            // TODO:
            // $serviceMegalosService->storeNewService($this->serviceName, $this->permission);
            // Reset the form fields
            $this->resetFields();
            // Emit the 'serviceCreated' event with a true status
            $this->emit('serviceCreated', true);
            return redirect()->route('backend.setup.admin.list-services')->with('success', 'Service was created successfully.');
            // // Redirect to the service.index page with a success message
        } catch (\Throwable $th) {
            // Show Message Error
            $this->dispatchErrorEvent('An error occurred while creating service : ' . $th->getMessage());
        }
    }
}
