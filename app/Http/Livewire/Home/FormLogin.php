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

    // TODO:
    /**
     * submit
     */
    public function submit(AdminService $adminService)
    {
        $this->validate();
        $validationResult = $adminService->validateAdmin($this->username, $this->password);
        // dd($validationResult);
        if ($validationResult) {
            $sessionKey = $validationResult['session_key'];
            $sessionData = $validationResult['session_data'];
            session([
                'fullname' => $sessionData['fullname'],
                'login_status' => $sessionData['login_status'],
            ]);

            return redirect()->route('backend.dashboard');
        }

        return session()->flash('error', 'Invalid Username or Password!.');
    }
}
