<?php

namespace App\Http\Livewire\Backend\Setup\Config\Form;

use App\Services\Nas\NasService;
use Livewire\Component;

class EditRouter extends Component
{
    public $nas_id, $server_ip_address, $mikrotik_ip_address, $mikrotik_api_port, $ports, $secret, $temporary_username, $temporary_password;

    // Livewire properties
    protected $listeners = [
        'nasUpdated' => '$refresh',
    ];

    // Validation rules
    protected $rules = [
        // Nullable fields
        'server_ip_address'     => 'nullable|ip',
        'mikrotik_ip_address'   => 'nullable|ip',
        'temporary_username'    => 'nullable',
        'temporary_password'    => 'nullable',

        // Required fields
        'mikrotik_api_port'     => 'required|integer|min:1|max:99999',
        'ports'                 => 'required|integer|min:1|max:99999',
        'secret'                => 'required',
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
        // Get the NAS parameters using the NasService
        /**
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
        $this->emit('closeModal');
    }

    /**
     * updateRouter
     *
     * @param  mixed $nasService
     * @return void
     */
    public function updateRouter(NasService $nasService)
    {
        // Validate the input fields
        $this->validate();

        // Create an array of data to be updated
        $data = [
            'id' => $this->nas_id,
            'mikrotikIP' => $this->mikrotik_ip_address,
            'mikrotikAPIPort' => $this->mikrotik_api_port,
            'serverIP' => $this->server_ip_address,
            'radiusPort' => $this->ports,
            'radiusSecret' => $this->secret,
            'username' => $this->temporary_username,
            'password' => $this->temporary_password
        ];
        // TODO: for insert to API Mikrotik

        dd($data);

        // Call the editNasProcess method from NasService to update the NAS record and settings
        $nasService->editNasProcess($data);

        // Emit an event to close the modal and show a success message
        $this->emit('closeModal');
        $this->emit('success', 'Router configuration has been updated successfully.');
    }
}
