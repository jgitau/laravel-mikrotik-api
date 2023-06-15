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

    /**
     * Fetches traffic data from the specified network interface of a device.
     * @param string $ip IP address of the device.
     * @param string $username Username for authentication.
     * @param string $password Password for authentication.
     * @param string $interface Network interface to monitor.
     * @return array Returns traffic data or throws an exception if an error occurs.
     * @throws Exception if unable to retrieve traffic data.
     */
    public function getTrafficData($ip, $username, $password, $interface)
    {
        try {
            return $this->mainRepository->getTrafficData($ip, $username, $password, $interface);
        } catch (Exception $exception) {
            throw new Exception("Error getting traffic data : " . $exception->getMessage());
        }
    }

    /**
     * Fetches DHCP Leases Data from the specified network interface of a device.
     * @param string $ip IP address of the device.
     * @param string $username Username for authentication.
     * @param string $password Password for authentication.
     * @return array Returns DHCP Leases Data or throws an exception if an error occurs.
     * @throws Exception if unable to retrieve DHCP Leases Data.
     */
    public function getDhcpLeasesData($ip, $username, $password)
    {
        try {
            return $this->mainRepository->getDhcpLeasesData($ip, $username, $password);
        } catch (Exception $exception) {
            throw new Exception("Error getting DHCP leases data : " . $exception->getMessage());
        }
    }

    /**
     * Retrieves DHCP Leases records from a database, initializes DataTables, adds columns to DataTable.
     * @return DataTables Yajra JSON response or null if there's no data.
     */
    public function getDhcpLeasesDatatables($ip, $username, $password)
    {
        try {
            return $this->mainRepository->getDhcpLeasesDatatables($ip, $username, $password);
        } catch (Exception $exception) {
            throw new Exception("Error getting DHCP leases datatable : " . $exception->getMessage());
        }
    }

    /**
     * Try to connect from the specified network interface of a device.
     * @param string $ip IP address of the device.
     * @param string $username Username for authentication.
     * @param string $password Password for authentication.
     * @return array Returns connect or throws an exception if an error occurs.
     * @throws Exception if unable to retrieve connect.
     */
    public function connect($ip, $username, $password)
    {
        try {
            return $this->mainRepository->connect($ip, $username, $password);
        } catch (Exception $exception) {
            throw new Exception("Error connect to mikrotik : " . $exception->getMessage());
        }
    }


}
