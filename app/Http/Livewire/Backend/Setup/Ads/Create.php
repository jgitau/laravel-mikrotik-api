<?php

namespace App\Http\Livewire\Backend\Setup\Ads;

use App\Models\AdType;
use App\Services\Config\Ads\AdsService;
use App\Traits\LivewireMessageEvents;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    // File Uploads for the Ads property
    use WithFileUploads;
    // LivewireMessageEvents for showing messages
    use LivewireMessageEvents;
    // Properties Public Variables
    public $type, $deviceType, $imageBanner, $title, $urlForImage = "http://", $position, $timeToShow, $timeToHide, $shortDescription;
    // Ads Type
    public $adsType;

    // Listeners
    protected $listeners = [
        'adCreated' => '$refresh',
    ];

    // Validation Rules for the Ads property
    protected $rules = [
        // REQUIRED
        'type'              => 'required',
        'imageBanner'       => 'required|image|mimes:jpg,jpeg,png,gif',
        'title'             => 'required|max:150',
        // NULLABLE
        'deviceType'        => 'nullable',
        'urlForImage'       => 'max:150',
        'position'          => 'nullable',
        'timeToShow'        => 'nullable|date',
        'timeToHide'        => 'nullable|date',
        'shortDescription'  => 'nullable',
    ];

    // Validation Messages for the Ads property
    protected $messages = [
        'type.required'         => 'Type cannot be empty!',
        'imageBanner.required'  => 'The Image Banner field is required.',
        'imageBanner.image'     => 'The Image Banner must be an image.',
        'imageBanner.mimes'     => 'The Image Banner must be a file of type: jpg, jpeg, png, gif.',
        'timeToShow.date'       => 'The time to show field must be a valid date.',
        'title.required'        => 'Title cannot be empty!',
        'title.max'             => 'Title cannot be more than 150 characters!',
        'urlForImage.max'       => 'Title cannot be more than 150 characters!',
        'timeToHide.date'       => 'The time to hide field must be a valid date.',
    ];

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
        return view('livewire.backend.setup.ads.create');
    }

    /**
     * Store a new ad.
     * @param AdsService $adsService Ad service instance
     */
    public function storeNewAd(AdsService $adsService)
    {
        // Validate form fields
        $this->validate();

        // List of properties to include in the new ad
        $properties = ['type', 'deviceType', 'imageBanner', 'title', 'urlForImage', 'position', 'timeToShow', 'timeToHide', 'shortDescription'];

        // Collect property values into an associative array
        $newAd = array_reduce($properties, function ($carry, $property) {
            $carry[$property] = $this->$property;
            return $carry;
        }, []);

        try {
            // Attempt to create the new ad
            $ad = $adsService->storeNewAd($newAd);

            // Check if the ad was created successfully
            if ($ad === null) {
                throw new \Exception('Failed to create the ad');
            }

            // Notify the frontend of success
            $this->dispatchSuccessEvent('Ad was created successfully.');

            // Reset the form for the next ad
            $this->resetFields();

            // Let other components know that an ad was created
            $this->emit('adCreated', true);
        } catch (\Throwable $th) {
            // Notify the frontend of the error
            $this->dispatchErrorEvent('An error occurred while creating ad : ' . $th->getMessage());
        } finally {
            // Ensure the modal is closed
            $this->closeModal();
        }
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
