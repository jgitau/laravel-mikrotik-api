<?php

namespace App\Http\Livewire\Backend\Setup\Config\VoucherPrintSetup;

use App\Services\Setting\SettingService;
use App\Traits\LivewireMessageEvents;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class LogoForm extends Component
{
    use WithFileUploads;
    use LivewireMessageEvents;

    // Public property for storing the logo
    public $logo;

    public $listeners = [
        'logoUpdated' => '$refresh',
        'confirmLogo' => 'clearLogo',
    ];

    // Validation rules for the logo property
    protected $rules = [
        'logo' => 'required|image|mimes:jpg,jpeg,png,gif|max:400', // Max size is in kilobytes
    ];
    // Validation messages for the logo property
    protected $messages = [
        'logo.required' => 'The logo field is required.',
        'logo.image'    => 'The logo must be an image.',
        'logo.mimes'    => 'The logo must be a file of type: jpg, jpeg, png, gif.',
        'logo.max'      => 'The logo may not be greater than 400 KB.',
    ];

    /**
     * Renders the component's view.
     * @return \Illuminate\View\View The view of the component
     */
    public function render()
    {
        return view('livewire.backend.setup.config.voucher-print-setup.logo-form');
    }

    /**
     * Upload the logo to the server and update the setting in the database.
     * @param SettingService $settingService
     * @return void
     */
    public function uploadLogo(SettingService $settingService)
    {
        // Validate the input
        $this->validate();

        try {
            // Check if the image is the right size
            $this->checkImageSize();

            // Save the file to the server
            $filePath = $this->saveLogoToServer();

            // Update the setting in the database
            $this->updateSetting($settingService, $filePath);

            // Show Success Message
            $this->dispatchSuccessEvent('Logo uploaded successfully.');

            // Reset the form fields
            $this->logo = null;

            // Emit the 'logoUploaded' event with a true status
            $this->emit('logoUpdated', true);
        } catch (\Throwable $th) {
            // Handle any errors that occur during the upload process
            $this->handleUploadError($th);
        }
    }

    /**
     * Clear the logo from the server and update the setting in the database.
     * @param SettingService $settingService
     * @return void
     */
    public function clearLogo(SettingService $settingService)
    {
        try {
            // Get the current logo filename from settings
            $logoSetting = $settingService->getSetting('voucher_logo_filename', 3);
            $currentLogoPath = $logoSetting;

            // Delete the file from the server
            if (Storage::disk('server')->exists($currentLogoPath)) {
                Storage::disk('server')->delete($currentLogoPath);
            }

            // Update the setting in the database to null
            $this->updateSetting($settingService, null);

            // Show Success Message
            $this->dispatchSuccessEvent('Logo removed successfully.');

            // Emit the 'logoUpdated' event with a false status
            $this->emit('logoUpdated', true);
        } catch (\Throwable $th) {
            // Handle any errors that occur during the deletion process
            $this->handleDeletionError($th);
        }
    }

    /**
     * Check if the image is the right size. Throw an exception if it is not.
     * @return void
     */
    protected function checkImageSize()
    {
        $image = Image::make($this->logo->getRealPath());
        $width = $image->width();
        $height = $image->height();
        // Check if the image is the right size
        if ($width > 80 || $height > 40) {
            throw new \Exception('Logo must be 80x40 pixels.');
        }
    }

    /**
     * Save the logo to the server and return the file path.
     *
     * @return string
     * @throws \Exception
     */
    protected function saveLogoToServer()
    {
        // Generate a unique name for the file
        $newFileName = str()->random(10) . '.' . $this->logo->getClientOriginalExtension();

        // The storage path
        $storagePath = 'files/images/' . $newFileName;
        // Use the storage facade to store the file
        if (!Storage::disk('server')->put($storagePath, file_get_contents($this->logo->getRealPath()))) {
            throw new \Exception('Failed to save logo.');
        }

        // return the storage path
        return $storagePath;
    }

    /**
     * Handle any errors that occur during the deletion process.
     * @param \Throwable $th
     * @return void
     */
    protected function handleDeletionError(\Throwable $th)
    {
        // Show Error Message
        $this->dispatchErrorEvent('An error occurred while removing logo : ' . $th->getMessage());
    }

    /**
     * Update the 'voucher_logo_filename' setting in the database.
     * @param SettingService $settingService
     * @param string $filePath
     * @return void
     */
    protected function updateSetting(SettingService $settingService, $filePath)
    {
        $settingService->updateSetting('voucher_logo_filename', 3, $filePath);
    }

    /**
     * Handle any errors that occur during the upload process.
     * @param \Throwable $th
     * @return void
     */
    protected function handleUploadError(\Throwable $th)
    {
        $this->logo = null;
        // Show Error Message
        $this->dispatchErrorEvent('An error occurred while uploading logo : ' . $th->getMessage());
    }
}
