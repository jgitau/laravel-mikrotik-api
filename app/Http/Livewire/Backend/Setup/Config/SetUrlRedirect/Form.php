<?php

namespace App\Http\Livewire\Backend\Setup\Config\SetUrlRedirect;

use App\Services\Config\ConfigService;
use App\Traits\LivewireMessageEvents;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class Form extends Component
{
    // Use Livewire Message Event
    use LivewireMessageEvents;

    // Set Properties Public Variables
    public $url;

    // Listeners
    protected $listeners = [
        'urlUpdated' => '$refresh',
    ];

    // Validation Rules
    protected $rules = [
        'url'  => 'url',
    ];

    // Custom Message
    protected $messages = [
        'url.url'       => 'The URL format is invalid.',
    ];

    /**
     * Mount the component.
     * @param ConfigService $configService The service to handle configuration related actions.
     */
    public function mount(ConfigService $configService)
    {
        $this->url = $configService->getUrlRedirect()->value;
    }

    /**
     * This function is automatically called by Livewire whenever a property is updated.
     * @param  string $property The name of the property that was updated.
     * @return void
     */
    public function updated($property)
    {
        // The validation rules are defined in the 'rules' method of the component.
        $this->validateOnly($property);
    }

    /**
     * @return \Illuminate\View\View The view to be rendered.
     */
    public function render()
    {
        // Return the view that corresponds to this component.
        return view('livewire.backend.setup.config.set-url-redirect.form');
    }

    /**
     * Update or delete the URL redirect based on user input.
     * @param ConfigService $configService The service that handles configuration-related actions.
     * @return void
     */
    public function updateUrlRedirect(ConfigService $configService)
    {
        // The validation rules are defined in the 'rules' method of the component.
        $this->validate();

        // Prepare the settings data for the service.
        $settings = ['url_redirect' => $this->url];

        // If the URL is not empty, it means the user wants to update the URL redirect.
        if (!empty($this->url)) {
            // Check if the URL actually exists.
            if ($this->isUrlExist($this->url)) {
                // If the URL exists, update it using the service.
                $configService->updateUrlRedirect($settings);

                // Dispatch an event to notify the user of success.
                $this->dispatchSuccessEvent('URL Saved!');

                // Emit an event to notify other components that the URL was updated.
                $this->emit('urlUpdated', true);
            } else {
                // If the URL does not exist, notify the user of the error.
                $this->dispatchErrorEvent('URL not found. Please check again.');
            }
        } else {
            // If the URL is empty, it means the user wants to delete the URL redirect.
            $configService->updateUrlRedirect($settings);

            // Dispatch an event to notify the user of success.
            $this->dispatchSuccessEvent('URL Deleted!');
        }
    }

    /**
     * Check if a URL exists.
     * This function uses PHP's native functions to check if the domain of the URL exists.
     * @param string $url The URL to check.
     * @return bool Returns true if the URL exists, false otherwise.
     */
    public function isUrlExist($url)
    {
        try {
            // Use PHP's built-in function to parse the URL and extract the host.
            $urlHost = parse_url($url, PHP_URL_HOST);

            // Use PHP's built-in function to check if the host has any DNS records.
            return checkdnsrr($urlHost, 'ANY');
        } catch (\Throwable $th) {
            // If any error occurs during the process, catch it and return false.
            return false;
        }
    }


}
