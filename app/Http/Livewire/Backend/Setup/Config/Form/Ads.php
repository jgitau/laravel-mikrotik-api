<?php

namespace App\Http\Livewire\Backend\Setup\Config\Form;

use App\Services\Config\Ads\AdsService;
use Livewire\Component;

class Ads extends Component
{

    // Declare Public Variables
    public $ads_max_width, $ads_max_height, $ads_max_size, $ads_upload_folder, $ads_thumb_width, $ads_thumb_height, $mobile_ads_max_width, $mobile_ads_max_height, $mobile_ads_max_size;

    // Livewire properties
    protected $listeners = [
        'nasUpdated' => '$refresh',
        'resetForm' => 'resetForm',
    ];

    // Validation rules
    protected function rules()
    {
        $numericRules = 'required|numeric|min:1|max:9999';
        return [
            'ads_max_width'           => $numericRules,
            'ads_max_height'          => $numericRules,
            'ads_max_size'            => $numericRules,
            'ads_upload_folder'       => 'required',
            'ads_thumb_width'         => $numericRules,
            'ads_thumb_height'        => $numericRules,
            'mobile_ads_max_width'    => $numericRules,
            'mobile_ads_max_height'   => $numericRules,
            'mobile_ads_max_size'     => $numericRules,
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

        $customMessages = [
            'ads_upload_folder.required' => 'The Ads Upload Folder field is required.',
        ];

        return array_merge($defaultMessages, $customMessages);
    }



    // /**
    //  * Retrieves the ADS parameters using the AdsService and stores them
    //  * in the corresponding Livewire properties. Renders the edit-router view.
    //  *
    //  * @param  AdsService $adsService
    //  * @return \Illuminate\View\View
    //  */
    public function mount(AdsService $adsService)
    {
        $this->resetForm($adsService);
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
     * render function
     */
    public function render()
    {
        return view('livewire.backend.setup.config.form.ads');
    }

    /**
     * updateAds
     *
     * @return void
     */
    public function updateAds(AdsService $adsService)
    {
        // Validate the form
        $this->validate();

        // Declare the ads settings
        $settings = [
            'ads_max_width' => $this->ads_max_width,
            'ads_max_height' => $this->ads_max_height,
            'ads_max_size' => $this->ads_max_size,
            'ads_upload_folder' => $this->ads_upload_folder,
            'ads_thumb_width' => $this->ads_thumb_width,
            'ads_thumb_height' => $this->ads_thumb_height,
            'mobile_ads_max_width' => $this->mobile_ads_max_width,
            'mobile_ads_max_height' => $this->mobile_ads_max_height,
            'mobile_ads_max_size' => $this->mobile_ads_max_size
        ];

        try {
            // Update the ads settings
            $adsService->updateAdsSettings($settings);

            // Show Message Success
            $this->dispatchSuccessEvent('Ads settings updated successfully.');
        } catch (\Throwable $th) {
            // Show Message Error
            $this->dispatchErrorEvent('An error occurred while updating ads settings: ' . $th->getMessage());
        }

        // Close Modal
        $this->closeModal();
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
     * Dispatch a success event with the given message
     *
     * @param string $message Success message to be displayed
     */
    private function dispatchSuccessEvent($message)
    {
        // Dispatch the browser event with the success message
        $this->dispatchBrowserEvent('message', ['success' => $message]);
        // Close the modal
        $this->closeModal();
        // Reset the form fields
        $this->resetFields();
        // Emit the 'adsUpdated' event with a true status
        $this->emitUp('adsUpdated', true);
    }

    /**
     * Dispatch an error event with the given message
     *
     * @param string $message Error message to be displayed
     */
    private function dispatchErrorEvent($message)
    {
        // Dispatch the browser event with the error message
        $this->dispatchBrowserEvent('message', ['error' => $message]);
        // Close the modal
        $this->closeModal();
    }

    /**
     * Retrieves the ADS parameters using the AdsService and stores them
     * in the corresponding Livewire properties. Renders the edit-router view.
     * @param  mixed $adsService
     * @return void
     */
    public function resetForm(AdsService $adsService)
    {
        // Get the ADS parameters using the AdsService
        /**
         * @var Ads $ads
         */
        $adsParameters = $adsService->getAdsParameters();
        // Convert the received data into an associative array and fill it into a Livewire variable
        $this->setLivewireVariables($adsParameters);
    }

    /**
     * resetFields
     *
     * @return void
     */
    public function resetFields()
    {
        $this->ads_max_width = '';
        $this->ads_max_height = '';
        $this->ads_max_size = '';
        $this->ads_upload_folder = '';
        $this->ads_thumb_width = '';
        $this->ads_thumb_height = '';
        $this->mobile_ads_max_width = '';
        $this->mobile_ads_max_height = '';
        $this->mobile_ads_max_size = '';
    }

    /**
     * setLivewireVariables
     *
     * @param  mixed $adsParameters
     * @return void
     */
    private function setLivewireVariables($adsParameters)
    {
        foreach ($adsParameters as $ads) {
            switch ($ads->setting) {
                case 'ads_max_width':
                    $this->ads_max_width = $ads->value;
                    break;
                case 'ads_max_height':
                    $this->ads_max_height = $ads->value;
                    break;
                case 'ads_max_size':
                    $this->ads_max_size = $ads->value;
                    break;
                case 'ads_upload_folder':
                    $this->ads_upload_folder = $ads->value;
                    break;
                case 'ads_thumb_width':
                    $this->ads_thumb_width = $ads->value;
                    break;
                case 'ads_thumb_height':
                    $this->ads_thumb_height = $ads->value;
                    break;
                case 'mobile_ads_max_width':
                    $this->mobile_ads_max_width = $ads->value;
                    break;
                case 'mobile_ads_max_height':
                    $this->mobile_ads_max_height = $ads->value;
                    break;
                case 'mobile_ads_max_size':
                    $this->mobile_ads_max_size = $ads->value;
                    break;
            }
        }
    }
}
