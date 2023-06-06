<?php

namespace App\Services\MikrotikApi;

use LaravelEasyRepository\Service;
use App\Repositories\MikrotikApi\MikrotikApiRepository;
use Exception;

class MikrotikApiServiceImplement extends Service implements MikrotikApiService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(MikrotikApiRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    /**
     * Retrieves active Mikrotik users using provided IP, username, and password.
     * @param string $ip The IP address of the Mikrotik router.
     * @param string $username The username used to authenticate with the Mikrotik router.
     * @param string $password The password needed to authenticate the user when connecting to the Mikrotik router.
     * @return mixed The result of calling the `getMikrotikUserActive` method of the `mainRepository` object.
     * @throws Exception If an error occurs while retrieving active users.
     */
    public function getMikrotikUserActive($ip, $username, $password)
    {
        try {
            return $this->mainRepository->getMikrotikUserActive($ip, $username, $password);
        } catch (Exception $exception) {
            throw new Exception("Error getting user active : " . $exception->getMessage());
        }
    }
}
