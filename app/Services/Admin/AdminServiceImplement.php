<?php

namespace App\Services\Admin;

use LaravelEasyRepository\Service;
use App\Repositories\Admin\AdminRepository;
use Illuminate\Support\Facades\Log;

class AdminServiceImplement extends Service implements AdminService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(AdminRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    /**
     * validateAdmin
     * @param  mixed $username
     * @param  mixed $password
     */
    public function validateAdmin($username, $password)
    {
        try {
            return $this->mainRepository->validateAdmin($username, $password);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
        }
    }


    /**
     * logout
     */
    public function logout()
    {
        try {
            return $this->mainRepository->logout();
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
        }
    }

    /**
     * getDatatables
     */
    public function getDatatables()
    {
        try {
            return $this->mainRepository->getDatatables();
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
        }
    }

    /**
     * storeNewAdmin
     *
     * @param  mixed $request
     * @return void
     */
    public function storeNewAdmin($request)
    {
        try {
            return $this->mainRepository->storeNewAdmin($request);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
        }
    }

    /**
     * updateAdmin
     * @param  mixed $admin_uid
     * @param  mixed $request
     * @return void
     */
    public function updateAdmin($admin_uid, $request)
    {
        try {
            return $this->mainRepository->updateAdmin($admin_uid, $request);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
        }
    }

    /**
     * getAdminByUid
     *
     * @param  mixed $uid
     * @return void
     */
    public function getAdminByUid($uid)
    {
        try {
            return $this->mainRepository->getAdminByUid($uid);
        } catch (\Throwable $th) {
            Log::debug($th->getMessage());
        }
    }
}
