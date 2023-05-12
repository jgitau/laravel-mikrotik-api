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
     * updateAdmin
     * @param  mixed $admin_uid
     * @param  mixed $request
     * @return void
     */
    public function updateAdmin($admin_uid, $request);

    /**
     * deleteAdmin
     * @param  mixed $admin_uid
     * @return void
     */
    public function deleteAdmin($admin_uid);

    /**
     * getAdminByUid
     *
     * @param  mixed $uid
     * @return void
     */
    public function getAdminByUid($uid);
}
