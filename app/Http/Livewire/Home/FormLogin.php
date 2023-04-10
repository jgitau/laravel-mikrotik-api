<?php

namespace App\Http\Livewire\Home;

use App\Services\Admin\AdminService;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class FormLogin extends Component
{

    public $username, $password;

    protected $rules = [
        'username' => 'required',
        'password' => 'required',
    ];

    protected $messages = [
        'username.required' => 'Username harus diisi!',
        'password.required' => 'Password harus diisi!',
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
