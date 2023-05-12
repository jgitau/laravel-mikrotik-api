<?php

namespace App\Services\Admin;

use LaravelEasyRepository\BaseService;

interface AdminService extends BaseService
{

    /**
     * validateAdmin
     * @param  mixed $username
     * @param  mixed $password
     */
    public function validateAdmin($username, $password);

    /**
     * logout
     */
    public function logout();

    /**
     * getDatatables
     */
    public function getDatatables();

    /**
     * storeNewAdmin
     *
     * @param  mixed $request
     * @return void
     */
    public function storeNewAdmin($request);

    /**
     * getAdminByUid
     *
     * @param  mixed $uid
     * @return void
     */
    public function getAdminByUid($uid);
}
