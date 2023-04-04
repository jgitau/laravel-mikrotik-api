<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminService;

class LoginController extends Controller
{
    protected $adminService;

    /**
     * __construct
     *
     * @param  mixed $adminService
     * @return void
     */
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * index
     */
    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('home.login.index', ['pageConfigs' => $pageConfigs]);
    }

    /**
     * logout
     */
    public function logout()
    {
        // Call the logout method from the repository and get the forgotten cookie
        $forgottenCookie = $this->adminService->logout();

        // Redirect to the login page or home page with the forgotten cookie
        return redirect('')->withCookie($forgottenCookie);
    }

}
