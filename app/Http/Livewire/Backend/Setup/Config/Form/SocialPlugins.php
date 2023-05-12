<?php

namespace App\Http\Livewire\Backend\Setup\Config\Form;

use App\Services\Config\SocialPlugin\SocialPluginService;
use App\Traits\LivewireMessageEvents;
use Livewire\Component;

class SocialPlugins extends Component
{
    use LivewireMessageEvents;

    // Declare Public Variables
    public $fb_app_id, $fb_app_secret, $tw_api_key, $tw_api_secret, $google_api_client_id,
        $login_with_facebook_on, $login_with_twitter_on, $login_with_google_on, $login_with_linkedin_on,
        $google_api_client_secret, $linkedin_api_client_id, $linkedin_api_client_secret;

    // Livewire properties
    protected $listeners = [
        'socialPluginUpdated' => '$refresh',
        'resetForm' => 'resetForm',
    ];

    // Validation rules
    protected function rules()
    {
        $numericRules = 'required|numeric|min:0|max:1';
        return [
            'fb_app_id'                  => 'required',
            'fb_app_secret'              => 'required',
            'tw_api_key'                 => 'required',
            'tw_api_secret'              => 'required',
            'google_api_client_id'       => 'required',
            'login_with_facebook_on'     => $numericRules,
            'login_with_twitter_on'      => $numericRules,
            'login_with_google_on'       => $numericRules,
            'login_with_linkedin_on'     => 'required',
            'google_api_client_secret'   => 'required',
            'linkedin_api_client_id'     => 'required',
            'linkedin_api_client_secret' => 'required',
        ];

    }


    // Validation messages
    protected function messages()
    {
        $defaultMessages = [
            'required' => 'The :attribute field is required.',
            'numeric' => 'The :attribute field must be a number.',
            'min' => 'The :attribute field must be at least :min.',
            'max' => 'The :attribute field may not be greater than :max.',
        ];

        // $customMessages = [
        //     'fb_app_id.required'                    => 'The Facebook App ID field is required.',
        //     'fb_app_secret.required'                => 'The Facebook App Secret field is required.',
        //     'tw_api_key.required'                   => 'The Twitter API Key field is required.',
        //     'tw_api_secret.required'                => 'The Twitter API Secret field is required.',
        //     'google_api_client_id.required'         => 'The Google API Client ID field is required.',
        //     'login_with_linkedin_on.required'       => 'The Login with LinkedIn field is required.',
        //     'google_api_client_secret.required'     => 'The Google API Client Secret field is required.',
        //     'linkedin_api_client_id.required'       => 'The LinkedIn API Client ID field is required.',
        //     'linkedin_api_client_secret.required'   => 'The LinkedIn API Client Secret field is required.',
        // ];

        return $defaultMessages;
    }

    /**
     * Retrieves the SOCIALPLUGIN parameters using the SocialPluginService and stores them
     * in the corresponding Livewire properties. Renders the edit-router view.
     *
     * @param  SocialPluginService $socialPluginService
     * @return \Illuminate\View\View
     */
    public function mount(SocialPluginService $socialPluginService)
    {
        $this->resetForm($socialPluginService);
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

    /**
     * Render View
     **/
    public function render()
    {
        return view('livewire.backend.setup.config.form.social-plugins');
    }


    /**
     * This function updates the social plugin settings and emits an event with the status of the
     * update.
     *
     * @param SocialPluginService socialPluginService It is an instance of the SocialPluginService
     * class, which is responsible for handling the business logic related to updating the social
     * plugin settings.
     */
    public function updateSocialPlugin(SocialPluginService $socialPluginService)
    {
        // Validate the form
        $this->validate();

        // Declare the public variable names
        $variables = [
            'fb_app_id', 'fb_app_secret', 'tw_api_key', 'tw_api_secret', 'google_api_client_id', 'login_with_facebook_on',
            'login_with_twitter_on', 'login_with_google_on', 'login_with_linkedin_on',
            'google_api_client_secret', 'linkedin_api_client_id', 'linkedin_api_client_secret',
        ];

        // Declare the settings
        $settings = [];

        // Fill the settings array with public variable values
        foreach ($variables as $variable) {
            $settings[$variable] = $this->$variable;
        }

        try {
            // Update the social plugin settings
            $socialPluginService->updateSocialPluginSettings($settings);

            // Show Message Success
            $this->dispatchSuccessEvent('Social Plugin settings updated successfully.');
            // Close the modal
            $this->closeModal();
            // Reset the form fields
            $this->resetFields();
            // Emit the 'socialPluginUpdated' event with a true status
            $this->emitUp('socialPluginUpdated', true);
        } catch (\Throwable $th) {
            // Show Message Error
            $this->dispatchErrorEvent('An error occurred while updating ads settings: ' . $th->getMessage());
            // Close the modal
            $this->closeModal();
        }

        // Close Modal
        $this->closeModal();
    }

    /**
     * Retrieves the SOCIALPLUGIN parameters using the SocialPluginService and stores them
     * in the corresponding Livewire properties. Renders the edit-router view.
     * @param  mixed $socialPluginService
     * @return void
     */
    public function resetForm(SocialPluginService $socialPluginService)
    {
        // Get the SOCIALPLUGIN parameters using the SocialPluginService
        /**
         * @var SocialPlugin $socialPlugin
         */
        $socialPluginParameters = $socialPluginService->getSocialPluginParameters();
        // Convert the received data into an associative array and fill it into a Livewire variable
        $this->setLivewireVariables($socialPluginParameters);
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
     * resetFields
     *
     * @return void
     */
    public function resetFields()
    {
        $this->fb_app_id = '';
        $this->fb_app_secret = '';
        $this->tw_api_key = '';
        $this->tw_api_secret = '';
        $this->google_api_client_id = '';
        $this->login_with_facebook_on = '';
        $this->login_with_twitter_on = '';
        $this->login_with_google_on = '';
        $this->login_with_linkedin_on = '';
        $this->google_api_client_secret = '';
        $this->linkedin_api_client_id = '';
        $this->linkedin_api_client_secret = '';
    }

    /**
     * setLivewireVariables
     *
     * @param  mixed $socialPluginParameters
     * @return void
     */
    private function setLivewireVariables($socialPluginParameters)
    {
        foreach ($socialPluginParameters as $socialPlugin) {
            if (property_exists($this, $socialPlugin->setting)) {
                $this->{$socialPlugin->setting} = $socialPlugin->value;
            }
        }
    }
}
