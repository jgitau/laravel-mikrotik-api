<?php

namespace App\Services\Group;

use LaravelEasyRepository\Service;
use App\Repositories\Group\GroupRepository;
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
}
