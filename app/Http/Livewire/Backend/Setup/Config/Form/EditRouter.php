<?php

namespace App\Http\Livewire\Backend\Setup\Config\Form;

use App\Services\Nas\NasService;
use App\Traits\LivewireMessageEvents;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Termwind\Components\Dd;

class EditRouter extends Component
{
    use LivewireMessageEvents;
    public $nas_id, $server_ip_address, $mikrotik_ip_address, $mikrotik_api_port, $ports, $secret, $temporary_username, $temporary_password;

    // Livewire properties
    protected $listeners = [
        'nasUpdated' => '$refresh',
        'resetForm' => 'resetForm',
    ];


    // Validation rules
    protected $rules = [
        // Nullable fields
        'server_ip_address'     => 'nullable|ip',
        'mikrotik_ip_address'   => 'nullable|ip',
        'temporary_password'    => 'nullable',

        // Required fields
        'mikrotik_api_port'     => 'required|integer|min:1|max:99999',
        'ports'                 => 'required|integer|min:1|max:99999',
        'secret'                => 'required',
        'temporary_username'    => 'required',
    ];

    // Validation messages
    protected $messages = [
        'server_ip_address.ip'          => 'Must be a valid Server IP address!',
        'mikrotik_ip_address.ip'        => 'Must be a valid Mikrotik IP address!',
        'mikrotik_api_port.required'    => 'API Port cannot be empty!',
        'mikrotik_api_port.integer'     => 'API Port must be an integer!',
        'mikrotik_api_port.min'         => 'API Port must be at least 1!',
        'mikrotik_api_port.max'         => 'API Port must be no more than 99999!',
        'ports.required'                => 'Radius Port cannot be empty!',
        'ports.integer'                 => 'Radius Port must be an integer!',
        'ports.min'                     => 'Radius Port must be at least 1!',
        'ports.max'                     => 'Radius Port must be no more than 99999!',
        'secret.required'               => 'Radius Secret cannot be empty!',
        'temporary_username.required'   => 'Temporary Username cannot be empty!',
    ];

    /**
     * Retrieves the NAS parameters using the NasService and stores them
     * in the corresponding Livewire properties. Renders the edit-router view.
     *
     * @param  NasService $nasService
     * @return \Illuminate\View\View
     */
    public function mount(NasService $nasService)
    {
        $this->resetForm($nasService);
    }


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

    public function render()
    {
        // Render the edit-router view
        return view('livewire.backend.setup.config.form.edit-router');
    }


    /**
     * closeModal
     *
     * @return void
     */
    public function closeModal()
    {
        $this->dispatchBrowserEvent('closeModal');
    }

    /**
     * updateRouter
     *
     * @param  mixed $nasService
     * @return void
     */
    public function updateRouter(NasService $nasService)
    {
        // Validate the input fields to ensure they meet the specified rules
        $this->validate();

        // Create an array of data to be updated based on the form inputs
        $nas = $nasService->getNasParameters();
        $data = [
            'id' => $this->nas_id,
            'mikrotikIP' => $this->mikrotik_ip_address,
            'mikrotikAPIPort' => $this->mikrotik_api_port,
            'serverIP' => $this->server_ip_address,
            'radiusPort' => $this->ports,
            'radiusSecret' => $this->secret,
            'tempUsername' => $this->temporary_username,
            'tempPassword' => $this->temporary_password,
            'username' => 'megalos',
            'password' => Hash::make('megalos'),
            'groupname' => 'megalos',
            'serverDomain' => env('MGL_SPLASH_DOMAIN'),
        ];

        try {
            // Call the setupProcess method from NasService to configure the Mikrotik router
            $mikrotikStatus = $nasService->setupProcess($nas, $data);

            // Check if the Mikrotik setup was successful
            if ($mikrotikStatus['status']) {
                // Call the editNasProcess method from NasService to update the NAS record and settings
                $status = $nasService->editNasProcess($data);

                // If the NAS update is successful, dispatch the success event
                if ($status) {
                    $this->dispatchSuccessEvent('Router settings updated successfully.');
                    // Emit the 'nasUpdated' event with a true status
                    $this->emitUp('nasUpdated', true);
                } else {
                    // If the NAS update is not successful, dispatch the error event with a message
                    $this->dispatchErrorEvent('An error occurred while updating router settings.');
                    // Reset the form fields
                    $this->resetFields();
                }
            } else {
                // If the Mikrotik setup is not successful, dispatch the error event
                $this->dispatchErrorEvent('An error occurred during the Mikrotik setup process.');
                // Reset the form fields
                $this->resetFields();
            }
        } catch (\Throwable $th) {
            // Show Message Error
            $this->dispatchErrorEvent('An error occurred while updating router settings: ' . $th->getMessage());
            // Reset the form fields
            $this->resetFields();
        }

        // Close Modal
        $this->closeModal();
    }

    /**
     * Retrieves the NAS parameters using the NasService and stores them
     * in the corresponding Livewire properties. Renders the edit-router view.
     * @param  mixed $nasService
     * @return void
     */
    public function resetForm(NasService $nasService)
    {
        /**
         * Get the NAS parameters using the NasService
         * @var Nas $nas
         */
        $nas = $nasService->getNasParameters();

        // Assign the NAS properties to the Livewire properties
        $this->nas_id = $nas->id ? $nas->id : 1;
        $this->server_ip_address = $nas->server_ip_address ? $nas->server_ip_address : '';
        $this->mikrotik_ip_address = $nas->mikrotik_ip_address ? $nas->mikrotik_ip_address : '';
        $this->mikrotik_api_port = $nas->mikrotik_api_port ? $nas->mikrotik_api_port : '8728';
        $this->ports = $nas->ports;
        $this->secret = $nas->secret;
    }


    /**
     * resetFields
     *
     * @return void
     */
    public function resetFields()
    {
        $this->server_ip_address = '';
        $this->mikrotik_ip_address = '';
        $this->temporary_username = '';
        $this->temporary_password = '';
    }
}
