<?php

namespace App\Repositories\Admin;

use LaravelEasyRepository\Repository;

interface AdminRepository extends Repository
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
}
