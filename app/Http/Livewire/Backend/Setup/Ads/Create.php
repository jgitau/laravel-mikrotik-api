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

    // FOR ALERT MESSAGE
    public $adsMaxWidth, $adsMaxHeight, $adsMaxSize, $mobileAdsMaxWidth, $mobileAdsMaxHeight, $mobileAdsMaxSize;

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
        'deviceType'        => 'required',
        // NULLABLE
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
        'deviceType.required'   => 'Device Type cannot be empty!',
        'title.max'             => 'Title cannot be more than 150 characters!',
        'urlForImage.max'       => 'Title cannot be more than 150 characters!',
        'timeToHide.date'       => 'The time to hide field must be a valid date.',
    ];

    /**
     * Initialize component state.
     */
    public function mount(AdsService $adsService)
    {
        $this->getSizeAds($adsService);
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
        // If type or deviceType has changed, dispatch an event to show an alert.
        // 1. Desktop max image width:160px, max image height: 390px
        if ($property === 'type' || $property === 'deviceType') {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'primary',
                'message' => $this->getMessageAlert(),
            ]);
        }
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

            $this->validateImage($newAd['imageBanner']);
            // Attempt to create the new ad
            $ad = $adsService->storeNewAd($newAd);

            // Check if the ad was created successfully
            if ($ad === null) {
                throw new \Exception('Failed to create the ad');
            }

            // Notify the frontend of success
            $this->dispatchSuccessEvent('Ad was created successfully.');

            // Let other components know that an ad was created
            $this->emit('adCreated', true);
        } catch (\Throwable $th) {
            // Notify the frontend of the error
            $this->dispatchErrorEvent($th->getMessage());
        } finally {

            // Reset the form for the next ad
            $this->resetFields();
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

    /**
     * Set the size properties for ads based on the provided AdsService.
     * @param AdsService $adsService The AdsService instance to retrieve the size values from.
     * @return void
     */
    private function getSizeAds(AdsService $adsService)
    {
        $this->adsMaxWidth = $adsService->adsMaxWidth();
        $this->adsMaxHeight = $adsService->adsMaxHeight();
        $this->adsMaxSize = $adsService->adsMaxSize();
        $this->mobileAdsMaxWidth = $adsService->mobileAdsMaxWidth();
        $this->mobileAdsMaxHeight = $adsService->mobileAdsMaxHeight();
        $this->mobileAdsMaxSize = $adsService->mobileAdsMaxSize();
    }

    /**
     * Generate the message for the alert.
     * @return string The message containing the upload limitations for desktop and mobile.
     */
    private function getMessageAlert()
    {
        return 'You can upload as many images as you want with the following limitations : <br>' .
            '1. Desktop Max Image Width : ' . $this->adsMaxWidth . 'px, Max Image Height : ' . $this->adsMaxHeight . "px, Max Image Size : " . $this->adsMaxSize . 'kb, per file <br>' .
            '2. Mobile Max Image Width : ' . $this->mobileAdsMaxWidth . 'px, Max Image Height : ' . $this->mobileAdsMaxHeight . "px, Max Image Size: " . $this->mobileAdsMaxSize . 'kb, per file ';
    }

    /**
     * Validate the image based on the device type.
     * @param Illuminate\Http\UploadedFile $image The uploaded image file
     * @throws Exception If the image dimensions or size exceed the maximum allowed for the selected device type
     * @return void
     */
    private function validateImage($image)
    {
        // Get the original dimensions of the image
        list($width, $height) = getimagesize($image->getRealPath());
        $data['width'] = $width;
        $data['height'] = $height;

        // Get the size of the image file in kilobytes
        $data['size'] = round(filesize($image->getRealPath()) / 1024); // convert from bytes to kilobytes and round off

        // Check if the selected device type is Desktop
        if ($this->deviceType === 'Desktop') {
            // Compare the width, height, and size of the image with the maximum limits for Desktop
            if ($data['width'] > $this->adsMaxWidth || $data['height'] > $this->adsMaxHeight || $data['size'] > $this->adsMaxSize) {
                // Throw an exception if the image dimensions or size exceed the maximum allowed for Desktop
                throw new \Exception("Desktop image exceeds max width: {$this->adsMaxWidth}px, height: {$this->adsMaxHeight}px or size: {$this->adsMaxSize}KB");
            }
        }
        // Check if the selected device type is Mobile
        elseif ($this->deviceType === 'Mobile') {
            // Compare the width, height, and size of the image with the maximum limits for Mobile
            if ($data['width'] > $this->mobileAdsMaxWidth || $data['height'] > $this->mobileAdsMaxHeight || $data['size'] > $this->mobileAdsMaxSize) {
                // Throw an exception if the image dimensions or size exceed the maximum allowed for Mobile
                throw new \Exception("Mobile image exceeds max width: {$this->mobileAdsMaxWidth}px, height: {$this->mobileAdsMaxHeight}px or size: {$this->mobileAdsMaxSize}KB");
            }
        }
    }
}
