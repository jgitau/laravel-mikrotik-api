<?php

namespace App\Http\Livewire\Backend\Setup\Config\Form;

use App\Services\Config\UserData\UserDataService;
use App\Traits\LivewireMessageEvents;
use Livewire\Component;

class UsersData extends Component
{
    use LivewireMessageEvents;
    // Declare Public Variables
    public $id_column, $name_column, $email_column, $phone_number_column, $room_number_column, $date_column, $first_name_column,
        $last_name_column, $mac_column, $location_column, $gender_column, $birthday_column, $login_with_column, $display_id,
        $display_name, $display_email, $display_phone_number, $display_room_number, $display_date, $display_first_name,
        $display_last_name, $display_mac, $display_location, $display_gender, $display_birthday, $display_login_with;

    // Livewire properties
    protected $listeners = [
        'userDataUpdated' => '$refresh',
        'resetForm' => 'resetForm',
    ];

    /**
     * This is a PHP function that returns an array of validation rules for columns and displays.
     * @return an array that contains validation rules for columns and displays. The validation rules
     * for columns include required, numeric, min, and max, while the validation rules for displays
     * include required, string, and regex. The function merges the two arrays of validation rules and
     * returns the resulting array.
     */
    protected function rules()
    {
        $columnRules = 'required|numeric|min:0|max:1';
        $displayRules = 'required|string|regex:/^[a-zA-Z0-9\s\-_]+$/';

        // Columns
        $columns = [
            'id_column' => $columnRules,
            'name_column' => $columnRules,
            'email_column' => $columnRules,
            'phone_number_column' => $columnRules,
            'room_number_column' => $columnRules,
            'date_column' => $columnRules,
            'first_name_column' => $columnRules,
            'last_name_column' => $columnRules,
            'mac_column' => $columnRules,
            'location_column' => $columnRules,
            'gender_column' => $columnRules,
            'birthday_column' => $columnRules,
            'login_with_column' => $columnRules,
        ];

        // Displays
        $displays = [
            'display_id' => $displayRules,
            'display_name' => $displayRules,
            'display_email' => $displayRules,
            'display_phone_number' => $displayRules,
            'display_room_number' => $displayRules,
            'display_date' => $displayRules,
            'display_first_name' => $displayRules,
            'display_last_name' => $displayRules,
            'display_mac' => $displayRules,
            'display_location' => $displayRules,
            'display_gender' => $displayRules,
            'display_birthday' => $displayRules,
            'display_login_with' => $displayRules,
        ];

        return array_merge(
            $columns,
            $displays
        );
    }

    /**
     * The function returns an array of default error messages for various validation rules in PHP.
     *
     * @return an array of default error messages for various validation rules such as 'required',
     * 'numeric', 'min', 'max', 'regex', and 'string'.
     */
    protected function messages()
    {
        $dafaultMessages = [
            'required' => 'The :attribute field is required.',
            'numeric' => 'The :attribute field must be a number.',
            'min' => 'The :attribute field must be at least :min.',
            'max' => 'The :attribute field may not be greater than :max.',
            'regex' => 'The :attribute field may only contain letters, numbers, spaces, dashes, and underscores.',
            'string' => 'The :attribute field must be string.',
        ];

        return $dafaultMessages;
    }

    /**
     * Retrieves the UserData parameters using the UserDataService and stores them
     * in the corresponding Livewire properties. Renders the edit-router view.
     *
     * @param  UserDataService $userDataService
     * @return \Illuminate\View\View
     */
    public function mount(UserDataService $userDataService)
    {
        $this->resetForm($userDataService);
    }


    public function updated($property)
    {
        // Every time a property changes
        // (only `text` for now), validate it
        $this->validateOnly($property);
    }

    /**
     * Render View
     */
    public function render()
    {
        return view('livewire.backend.setup.config.form.users-data');
    }


    /**
     * This function updates user data settings and emits an event with the status of the update.
     *
     * @param UserDataService userDataService userDataService is an instance of the UserDataService
     * class, which is a service class responsible for handling the logic related to user data
     * settings, such as updating the settings in the database. It is injected into the updateUserData
     * method as a dependency, allowing the method to call its methods and use its functionality.
     */
    public function updateUserData(UserDataService $userDataService)
    {
        // Validate the form
        $this->validate();

        // Declare the public variable names
        $variables = [
            'id_column', 'name_column', 'email_column', 'phone_number_column', 'room_number_column', 'date_column', 'first_name_column',
            'last_name_column', 'mac_column', 'location_column', 'gender_column', 'birthday_column', 'login_with_column', 'display_id',
            'display_name', 'display_email', 'display_phone_number', 'display_room_number', 'display_date', 'display_first_name',
            'display_last_name', 'display_mac', 'display_location', 'display_gender', 'display_birthday', 'display_login_with'
        ];

        // Declare the settings
        $settings = [];

        // Fill the settings array with public variable values
        foreach ($variables as $variable) {
            $settings[$variable] = $this->$variable;
        }

        try {
            // Update the user Data settings
            $userDataService->updateUserDataSettings($settings);

            // Show Message Success
            $this->dispatchSuccessEvent('User Data settings updated successfully.');
            // Emit the 'userDataUpdated' event with a true status
            $this->emitUp('userDataUpdated', true);
        } catch (\Throwable $th) {
            // Show Message Error
            $this->dispatchErrorEvent('An error occurred while updating user Data settings: ' . $th->getMessage());
        }

        // Close Modal
        $this->closeModal();
    }

    /**
     * Retrieves the UserData parameters using the UserDataService and stores them
     * in the corresponding Livewire properties. Renders the edit-router view.
     * @param  mixed $userDataService
     * @return void
     */
    public function resetForm(UserDataService $userDataService)
    {
        /**
         * Get the USERDATA parameters using the UserDataService
         * @var UserData $userData
         */
        $userDataParameters = $userDataService->getUserDataParameters();
        // Convert the received data into an associative array and fill it into a Livewire variable
        $this->setLivewireVariables($userDataParameters);
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
     * The function resets the values of public variables to an empty string.
     */
    public function resetFields()
    {
        // Declare the public variable names
        $variables = [
            'id_column', 'name_column', 'email_column', 'phone_number_column', 'room_number_column', 'date_column', 'first_name_column',
            'last_name_column', 'mac_column', 'location_column', 'gender_column', 'birthday_column', 'login_with_column', 'display_id',
            'display_name', 'display_email', 'display_phone_number', 'display_room_number', 'display_date', 'display_first_name',
            'display_last_name', 'display_mac', 'display_location', 'display_gender', 'display_birthday', 'display_login_with'
        ];

        // Reset the public variable values
        foreach ($variables as $variable) {
            $this->$variable = '';
        }
    }


    /**
     * setLivewireVariables
     *
     * @param  mixed $userDataParameters
     * @return void
     */
    private function setLivewireVariables($userDataParameters)
    {
        foreach ($userDataParameters as $userData) {
            if (property_exists($this, $userData->setting)) {
                $this->{$userData->setting} = $userData->value;
            }
        }
    }
}
