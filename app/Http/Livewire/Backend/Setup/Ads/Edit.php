<?php

namespace App\Http\Livewire\Backend\Setup\Ads;

use App\Models\Ad;
use App\Models\AdType;
use App\Services\Config\Ads\AdsService;
use App\Traits\LivewireMessageEvents;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    // File Uploads for the Ads property
    use WithFileUploads;
    // LivewireMessageEvents for showing messages
    use LivewireMessageEvents;
    // Properties Public Variables
    public $ads_id, $type, $deviceType, $imageBanner, $title, $urlForImage = "http://", $position, $timeToShow, $timeToHide, $shortDescription;
    // Ads Type
    public $adsType;

    // Listeners
    protected $listeners = [
        'getAd' => 'showAd',
        'adUpdated' => '$refresh',
    ];

    /**
     * Validation rules for updating an ad.
     * @return array
     */
    protected function getRules()
    {
        $rules = [
            'type'              => 'required',
            'title'             => 'required|max:150',
            'deviceType'        => 'nullable',
            'urlForImage'       => 'max:150',
            'position'          => 'nullable',
            'timeToShow'        => 'nullable|date',
            'timeToHide'        => 'nullable|date',
            'shortDescription'  => 'nullable',
        ];

        if ($this->imageBanner) {
            $rules['imageBanner'] = 'image|mimes:jpg,jpeg,png,gif';
        }

        return $rules;
    }

    /**
     * Validation messages.
     * @return array
     */
    protected function getMessages()
    {
        $messages = [
            'type.required'         => 'Type cannot be empty!',
            'title.required'        => 'Title cannot be empty!',
            'title.max'             => 'Title cannot be more than 150 characters!',
            'urlForImage.max'       => 'URL for image cannot be more than 150 characters!',
            'timeToShow.date'       => 'The time to show field must be a valid date.',
            'timeToHide.date'       => 'The time to hide field must be a valid date.',
        ];

        if ($this->imageBanner) {
            $messages['imageBanner.image'] = 'The Image Banner must be an image.';
            $messages['imageBanner.mimes'] = 'The Image Banner must be a file of type: jpg, jpeg, png, gif.';
        }

        return $messages;
    }

    /**
     * Initialize component state.
     */
    public function mount()
    {
        // Fetch all groups ordered by creation date
        $this->adsType = AdType::latest()->get();
    }

    /**
     * Event handler for property updates.
     * @param string $property Property that was updated
     */
    public function updated($property)
    {
        // Validate the updated property
        $this->validateOnly($property);
    }

    /**
     * Render the component `create`.
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backend.setup.ads.edit');
    }

    /**
     * Update Ad details.
     * @param  AdService $adService
     * @return void
     */
    public function updateAd(AdsService $adService)
    {

        // Validate the data first
        $this->validate();
        // List of properties to include in the new ad
        $properties = ['type', 'deviceType', 'imageBanner', 'title', 'urlForImage', 'position', 'timeToShow', 'timeToHide', 'shortDescription'
        ];

        // Collect property values into an associative array
        $newAd = array_reduce($properties, function ($carry, $property) {
            $carry[$property] = $this->$property;
            return $carry;
        }, []);

        try {
            // Update the ad dataAd
            $adService->updateAd($newAd, $this->ads_id);

            // Show Message Success
            $this->dispatchSuccessEvent('Ad successfully updated.');
            // Close the modal
            $this->closeModal();
            // Reset the form fields
            $this->resetFields();
            // Emit the 'adUpdated' event with a true status
            $this->emit('adUpdated', true);
        } catch (\Throwable $th) {
            // Show Message Error
            $this->dispatchErrorEvent('An error occurred while updating ad: ' . $th->getMessage());
            // Close the modal
            $this->closeModal();
        }

        // Close Modal
        $this->closeModal();
    }

    /**
     * Load ad details into the component.
     * @param  int $id
     * @return void
     */
    public function showAd($id)
    {
        // Fetch the ad with the given id
        $ad = Ad::findOrFail($id);
        $this->dispatchBrowserEvent('show-modal');
        // Assign the ad attributes to the component's public properties
        $this->ads_id = $ad->id;
        $this->type = $ad->type;
        $this->deviceType = $ad->device_type;
        // $this->imageBanner = $ad->file_name; // Please note that you cannot assign a file here. You might need a different approach.
        $this->title = $ad->title;
        $this->urlForImage = $ad->url_for_image;
        $this->position = $ad->position;

        // Check if timeToShow and timeToHide is not 0, then convert it to date
        $this->timeToShow = ($ad->time_to_show != 0) ? date('Y-m-d', $ad->time_to_show) : null;
        $this->timeToHide = ($ad->time_to_hide != 0) ? date('Y-m-d', $ad->time_to_hide) : null;

        $this->shortDescription = $ad->short_description;
    }


    /**
     * Close the modal.
     */
    public function closeModal()
    {
        $this->dispatchBrowserEvent('hide-modal');
    }

    /**
     * resetFields the form fields.
     * @return void
     */
    public function resetFields()
    {
        $this->ads_id             = null;
        $this->type             = null;
        $this->deviceType       = null;
        $this->imageBanner      = null;
        $this->title            = null;
        $this->urlForImage      = null;
        $this->position         = null;
        $this->timeToShow       = null;
        $this->timeToHide       = null;
        $this->shortDescription = null;
    }
}
