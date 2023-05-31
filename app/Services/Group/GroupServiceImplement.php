<?php

namespace App\Services\Group;

use LaravelEasyRepository\Service;
use App\Repositories\Group\GroupRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class GroupServiceImplement extends Service implements GroupService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(GroupRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
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
            return [];
            //throw $th;
        }
    }

    /**
     * @return The `getDataPermissions()` function is returning the result of calling the `getDataPermissions()`
     * method on the `` object.
     */
    public function getDataPermissions()
    {
        try {
            return $this->mainRepository->getDataPermissions();
        } catch (Exception $exception) {
            throw new Exception("Error getting data permissions : " . $exception->getMessage());
        }
    }

    /**
     * storeNewGroup
     * @param  mixed $request
     * @param  mixed $permissions
     */
    public function storeNewGroup($groupName, $permissions)
    {
        try {
            return $this->mainRepository->storeNewGroup($groupName, $permissions);
        } catch (Exception $exception) {
            throw new Exception("Error storing group : " . $exception->getMessage());
        }
    }
}
