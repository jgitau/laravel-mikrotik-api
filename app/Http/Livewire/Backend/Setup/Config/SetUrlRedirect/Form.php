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
     *
     * This function retrieves the current URL redirect setting using ConfigService and assigns it to a public variable.
     * @param ConfigService $configService The service to handle configuration related actions.
     */
    public function mount(ConfigService $configService)
    {
        $this->url = $configService->getUrlRedirect()->value;
    }


    /**
     * Render the livewire component
     */
    public function render()
    {
        return view('livewire.backend.setup.config.set-url-redirect.form');
    }

    /**
     * Handle URL Redirect Update.
     *
     * This function either updates the URL redirect or deletes it based on the user input.
     * @param ConfigService $configService The service to handle configuration related actions.
     */
    public function updateUrlRedirect(ConfigService $configService)
    {
        // Validate user input according to the defined validation rules.
        $this->validate();

        // Create an array containing the updated URL redirect.
        $settings = ['url_redirect' => $this->url];

        // If URL is not empty, then it needs to be updated.
        if (!empty($this->url)) {
            // Check if the entered URL actually exists.
            if ($this->isUrlExist($this->url)) {
                // If it exists, update the URL redirect in the database.
                $configService->updateUrlRedirect($settings);

                // Emit a success event to be caught by the front-end for user notification.
                $this->dispatchSuccessEvent('URL Saved!');

                // Emit event to refresh the page after successful URL update.
                $this->emit('urlUpdated', true);
            } else {
                // If URL does not exist, emit an error event to notify the user.
                $this->dispatchErrorEvent('URL not found. Please check again.');
            }
        } else {
            // If URL is empty, it means the URL redirect needs to be deleted.
            $configService->updateUrlRedirect($settings);

            // Emit a success event to be caught by the front-end for user notification.
            $this->dispatchSuccessEvent('URL Deleted!');
        }
    }

    /**
     * Check if a URL exists.
     *
     * This function uses PHP's native functions to check if the domain of the URL exists.
     * @param string $url The URL to be checked.
     * @return bool Returns true if the URL exists, false otherwise.
     */
    public function isUrlExist($url)
    {
        try {
            // Parse the URL to get the host name.
            $urlHost = parse_url($url, PHP_URL_HOST);
            // Check if the host name resolves to any DNS records.
            return checkdnsrr($urlHost, 'ANY');
        } catch (\Throwable $th) {
            // If any errors occur during the check, return false.
            return false;
        }
    }

}
