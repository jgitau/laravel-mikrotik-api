<?php

namespace App\Http\Livewire\Home;

use App\Services\Admin\AdminService;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class FormLogin extends Component
{

    // Declare public variables for username and password
    public $username, $password;

    // Define an array of validation rules for the variables
    protected $rules = [
        'username' => 'required', // The username is required
        'password' => 'required', // The password is required
    ];

    // Define an array of custom error messages for validation failures
    protected $messages = [
        'username.required' => 'Username is required!', // Error message if the username is not provided
        'password.required' => 'Password is required!', // Error message if the password is not provided
    ];

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
     * render
     */
    public function render()
    {
        return view('livewire.home.form-login');
    }

    /**
     * submit
     *
     * @param  mixed $adminService
     * @return void
     */
    public function submit(AdminService $adminService)
    {
        // Validate the input fields
        $this->validate();

        // Call the validateAdmin method from the AdminService to validate the credentials
        $validationResult = $adminService->validateAdmin($this->username, $this->password);

        // If the validation is successful
        if ($validationResult) {
            // Get the session data from the validation result
            $sessionData = $validationResult['session_data'];

            // Set the session data for the authenticated user
            session([
                'user_uid' => $sessionData['user_uid'],
                'fullname' => $sessionData['fullname'],
                'login_status' => $sessionData['login_status'],
                'role' => $sessionData['role'],
                'username' => $sessionData['username'],
            ]);

            // Redirect the user to the backend dashboard
            return redirect()->route('backend.dashboard');
        }

        // If the validation fails, flash an error message
        return session()->flash('error', 'Invalid Username or Password!.');
    }
}
