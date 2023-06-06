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

    /**
     * Retrieves Mikrotik CPU Load using provided IP, username, and password.
     * @param string $ip The IP address of the Mikrotik router.
     * @param string $username The username used to authenticate with the Mikrotik router.
     * @param string $password The password needed to authenticate the user when connecting to the Mikrotik router.
     * @return mixed The result of calling the `getMikrotikCpuLoad` method of the `mainRepository` object.
     * @throws Exception If an error occurs while retrieving mikrotik CPU Load.
     */
    public function getMikrotikCpuLoad($ip, $username, $password)
    {
        try {
            return $this->mainRepository->getMikrotikCpuLoad($ip, $username, $password);
        } catch (Exception $exception) {
            throw new Exception("Error getting user active : " . $exception->getMessage());
        }
    }

    /**
     * Retrieves Active Hotspot using provided IP, username, and password.
     * @param string $ip The IP address of the Mikrotik router.
     * @param string $username The username used to authenticate with the Mikrotik router.
     * @param string $password The password needed to authenticate the user when connecting to the Mikrotik router.
     * @return mixed The result of calling the `getMikrotikActiveHotspot` method of the `mainRepository` object.
     * @throws Exception If an error occurs while retrieving active hotspots.
     */
    public function getMikrotikActiveHotspot($ip, $username, $password)
    {
        try {
            return $this->mainRepository->getMikrotikActiveHotspot($ip, $username, $password);
        } catch (Exception $exception) {
            throw new Exception("Error getting active hotspot : " . $exception->getMessage());
        }
    }

    /**
     * Retrieves Free Memory using provided IP, username, and password.
     * @param string $ip The IP address of the Mikrotik router.
     * @param string $username The username used to authenticate with the Mikrotik router.
     * @param string $password The password needed to authenticate the user when connecting to the Mikrotik router.
     * @return mixed The result of calling the `getMikrotikFreeMemoryPercentage` method of the `mainRepository` object.
     * @throws Exception If an error occurs while retrieving free Memory.
     */
    public function getMikrotikFreeMemoryPercentage($ip, $username, $password)
    {
        try {
            return $this->mainRepository->getMikrotikFreeMemoryPercentage($ip, $username, $password);
        } catch (Exception $exception) {
            throw new Exception("Error getting free memory : " . $exception->getMessage());
        }
    }

    /**
     * Retrieves Uptime using provided IP, username, and password.
     * @param string $ip The IP address of the Mikrotik router.
     * @param string $username The username used to authenticate with the Mikrotik router.
     * @param string $password The password needed to authenticate the user when connecting to the Mikrotik router.
     * @return mixed The result of calling the `getMikrotikUptime` method of the `mainRepository` object.
     * @throws Exception If an error occurs while retrieving uptime.
     */
    public function getMikrotikUptime($ip, $username, $password)
    {
        try {
            return $this->mainRepository->getMikrotikUptime($ip, $username, $password);
        } catch (Exception $exception) {
            throw new Exception("Error getting uptime : " . $exception->getMessage());
        }
    }

    /**
     * Retrieves Resource data using provided IP, username, and password.
     * @param string $ip The IP address of the Mikrotik router.
     * @param string $username The username used to authenticate with the Mikrotik router.
     * @param string $password The password needed to authenticate the user when connecting to the Mikrotik router.
     * @return mixed The result of calling the `getMikrotikResourceData` method of the `mainRepository` object.
     * @throws Exception If an error occurs while retrieving resource data.
     */
    public function getMikrotikResourceData($ip, $username, $password)
    {
        try {
            return $this->mainRepository->getMikrotikResourceData($ip, $username, $password);
        } catch (Exception $exception) {
            throw new Exception("Error getting resource data : " . $exception->getMessage());
        }
    }
}
