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
        'url'  => 'required|url',
    ];

    // Custom Message
    protected $messages = [
        'url.required'  => 'The URL cannot be empty.',
        'url.url'       => 'The URL format is invalid.',
    ];

    /**
     * @param ConfigService configService  is an instance of the ConfigService class,
     * which is used to retrieve configuration settings for the application. It is likely that the
     * getUrlRedirect() method of the ConfigService class returns a URL that the application should
     * redirect to.
     */
    public function mount(ConfigService $configService)
    {
        $dataUrl = $configService->getUrlRedirect();
        $this->url = $dataUrl->value;
    }

    /**
     * Render the livewire component
     */
    public function render()
    {
        return view('livewire.backend.setup.config.set-url-redirect.form');
    }

    public function updateUrlRedirect(ConfigService $configService)
    {
        // Validate the form
        $this->validate();

        // Declare the settings
        $settings = ['url_redirect' => $this->url];


        if (!empty($this->url)) {
            if ($this->isUrlExist($this->url)) {
                // Save URL to database
                $update = $configService->updateUrlRedirect($settings);

                // Use your logic to save URL here
                $this->dispatchSuccessEvent('URL Saved!');
                // Emit the 'serviceCreated' event with a true status
                $this->emit('urlUpdated', true);
            } else {
                $this->dispatchErrorEvent('URL not found. Please check again.');
            }
        } else {
            // Delete URL from database
            // Use your logic to delete URL here
            $this->dispatchSuccessEvent('URL Deleted!');
        }
    }


    // Method to check if URL exists
    public function isUrlExist($url)
    {
        try {
            $urlHost = parse_url($url, PHP_URL_HOST);
            return checkdnsrr($urlHost, 'ANY');
        } catch (\Throwable $th) {
            return false;
        }
    }
}
