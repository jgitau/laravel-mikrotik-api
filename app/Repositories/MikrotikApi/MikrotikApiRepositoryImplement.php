<?php

namespace App\Repositories\MikrotikApi;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\RouterOsApi;
use Illuminate\Support\Facades\Log;

class MikrotikApiRepositoryImplement extends Eloquent implements MikrotikApiRepository
{

    /**
     * Define RouterOS API endpoints
     */
    const ENDPOINT_ACTIVE = "/ip/hotspot/active/print";
    const ENDPOINT_IP_BINDING = "/ip/hotspot/ip-binding/print";
    const ENDPOINT_RESOURCE = "/system/resource/print";
    const ENDPOINT_MONITOR_TRAFFIC = "/interface/monitor-traffic"; // Define Interface monitor traffic API endpoint


    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;
    protected $isConnected = false;

    // Construct function initializes Mikrotik Model
    public function __construct(RouterOsApi $model)
    {
        // Assuming this is where you're initializing the object to interact with Mikrotik API.
        $this->model = $model;
    }

    /**
     * Connect to a Mikrotik router.
     *
     * @param string $ip Router IP
     * @param string $username Username for authentication
     * @param string $password Password for authentication
     *
     * @return bool Connection status
     */
    // *** TODO: THIS IS FOR CONNECT ROUTER OS API NO CURL ***
    public function connect($ip, $username, $password)
    {
        // If already connected, return true
        if ($this->isConnected) {
            return true;
        }

        // Try to connect, log error and return false on failure
        if (!$this->model->connect($ip, $username, $password)) {
            Log::error('Failed to connect to Mikrotik router: ' . $ip);
            return false;
        }

        // Mark as connected on success
        $this->isConnected = true;

        // Return connection success
        return true;
    }


    /**
     * Retrieves Mikrotik interface data via RouterOS API.
     * @param string $ip Mikrotik router IP address.
     * @param string $username Authentication username.
     * @param string $password Authentication password.
     * @return array|null Mikrotik interface data or null on connection failure.
     */
    // public function getMikrotikUserActive($ip, $username, $password)
    // {
    //     try {
    //         // Connect to the Mikrotik router. If connection fails, log the error and return null.
    //         if (!$this->model->connect($ip, $username, $password)) {
    //             Log::error('Failed to connect to Mikrotik router: ' . $ip);
    //             return null;
    //         }

    //         // Fetch list of active users and IP bindings
    //         $userActive = $this->model->comm(self::ENDPOINT_ACTIVE);
    //         $ipBindings = $this->model->comm(self::ENDPOINT_IP_BINDING);

    //         // Filter bypassed IP bindings
    //         $ipBindingBypassed = array_filter($ipBindings, function ($binding) {
    //             return isset($binding['type']) && $binding['type'] === 'bypassed' && isset($binding['disabled']) && $binding['disabled'] === "false";
    //         });

    //         // Filter blocked IP bindings
    //         $ipBindingBlocked = array_filter($ipBindings, function ($binding) {
    //             return isset($binding['type']) && $binding['type'] === 'blocked' && isset($binding['disabled']) && $binding['disabled'] === "false";
    //         });

    //         // Return the counts of active users, bypassed and blocked IP bindings
    //         return [
    //             'userActive' => count($userActive),
    //             'ipBindingBypassed' => count($ipBindingBypassed),
    //             'ipBindingBlocked' => count($ipBindingBlocked),
    //         ];
    //     } catch (\Exception $e) {
    //         // If any error occurs, log the error message and return null
    //         Log::error('Failed to get Mikrotik interface data: ' . $e->getMessage());
    //         return null;
    //     }
    // }

    /**
     * Retrieves active hotspot data from a Mikrotik router.
     * @param string $ip The IP address of the Mikrotik router to connect to.
     * @param string $username The username used to authenticate with the Mikrotik router.
     * @param string $password The password credential required to access the Mikrotik router.
     * @return array|null The active hotspot data from the Mikrotik router, or null on error.
     */
    // public function getMikrotikActiveHotspot($ip, $username, $password)
    // {
    //     try {
    //         // Connect to the Mikrotik router. If connection fails, log the error and return null.
    //         if (!$this->model->connect($ip, $username, $password)) {
    //             Log::error('Failed to connect to Mikrotik router: ' . $ip);
    //             return null;
    //         }

    //         // Fetch active hotspot data
    //         $activeHotspot = $this->model->comm("/ip/hotspot/active/print");

    //         // Return the active hotspot data
    //         return count($activeHotspot);
    //     } catch (\Exception $e) {
    //         // If any error occurs, log the error message and return null
    //         Log::error('Failed to get Mikrotik active hotspot: ' . $e->getMessage());
    //         return null;
    //     }
    // }

    /**
     * Retrieves Mikrotik resource data via RouterOS API.
     * @param string $ip Mikrotik router IP address.
     * @param string $username Authentication username.
     * @param string $password Authentication password.
     * @return array|null Mikrotik resource data or null on connection failure.
     */
    // public function getMikrotikResourceData($ip, $username, $password)
    // {
    //     try {
    //         // Connect to the Mikrotik router. If connection fails, log the error and return null.
    //         if (!$this->model->connect($ip, $username, $password)) {
    //             Log::error('Failed to connect to Mikrotik router: ' . $ip);
    //             return null;
    //         }

    //         // Fetch system resource data
    //         $systemResource = $this->model->comm(self::ENDPOINT_RESOURCE);

    //         if (empty($systemResource[0])) {
    //             Log::error('Failed to get Mikrotik resource data: Empty response.');
    //             return null;
    //         }

    //         // Extract the data from the response
    //         ['uptime' => $uptime, 'freeMemoryPercentage' => $freeMemoryPercentage, 'cpuLoad' => $cpuLoad] = $this->processSystemResource($systemResource[0]);

    //         // Fetch active hotspot data
    //         $activeHotspot = $this->getMikrotikActiveHotspot($ip, $username, $password);

    //         return [
    //             'uptime' => $uptime,
    //             'freeMemoryPercentage' => $freeMemoryPercentage,
    //             'cpuLoad' => $cpuLoad,
    //             'activeHotspot' => $activeHotspot,
    //         ];
    //     } catch (\Exception $e) {
    //         // If any error occurs, log the error message and return null
    //         Log::error('Failed to get Mikrotik resource data: ' . $e->getMessage());
    //         return null;
    //     }
    // }

    /**
     * Method to get current upload and download traffic data from a Mikrotik router.
     * @param string $ip @param string $username @param string $password @param string $interface @return array
     */
    // public function getTrafficData($ip, $username, $password, $interface = null)
    // {
    //     // Connect to the Mikrotik router
    //     if (!$this->model->connect($ip, $username, $password)) {
    //         // If connection fails, return default values
    //         return [
    //             'uploadTraffic' => 0,
    //             'downloadTraffic' => 0
    //         ];
    //     }

    //     $interface  = env('MIKROTIK_INTERFACE');
    //     // Send the request to the monitor traffic endpoint
    //     $response = $this->model->comm(self::ENDPOINT_MONITOR_TRAFFIC, [
    //         "interface" => $interface,
    //         "once" => ""
    //     ]);

    //     if (isset($response[0])) {
    //         // Get the traffic data
    //         $trafficData = $response[0];

    //         $uploadTraffic = isset($trafficData['tx-bits-per-second']) ? round($trafficData['tx-bits-per-second'] / 1000) : 0;
    //         $downloadTraffic = isset($trafficData['rx-bits-per-second']) ? round($trafficData['rx-bits-per-second'] / 1000) : 0;

    //         return [
    //             'uploadTraffic' => $uploadTraffic ,
    //             'downloadTraffic' => $downloadTraffic
    //         ];
    //     }

    //     return [
    //         'uploadTraffic' => 0,
    //         'downloadTraffic' => 0
    //     ];
    // }

    /**
     ******* GET request to the Mikrotik router. WITH CURL **
     */

    /**
     * Fetches active hotspot data from a Mikrotik device using cURL.
     * @param string $ip The IP address of the Mikrotik device.
     * @param string $username The username for the Mikrotik device.
     * @param string $password The password for the Mikrotik device.
     * @return int|null Returns the number of active hotspots, or null if the connection fails.
     */
    public function getMikrotikActiveHotspot($ip, $username, $password)
    {
        // Retrieve active hotspot data from the Mikrotik device
        $hotspotActive = $this->connectAndRetrieveData($ip, $username, $password, 'ip/hotspot/active/print', ['count-only' => 'true']);

        // Return null if the connection failed
        if ($hotspotActive === null) {
            return null;
        }

        // Return the number of active hotspots
        return $hotspotActive['ret'];
    }

    /**
     * Fetches system resource and active hotspot data from a Mikrotik device using cURL.
     * @param string $ip The IP address of the Mikrotik device.
     * @param string $username The username for the Mikrotik device.
     * @param string $password The password for the Mikrotik device.
     * @return array|null Returns an array with keys 'uptime', 'freeMemoryPercentage', 'cpuLoad', 'activeHotspot'
     */
    public function getMikrotikResourceData($ip, $username, $password)
    {
        // Retrieve system resource data from the Mikrotik device
        $systemResource = $this->connectAndRetrieveData($ip, $username, $password, 'system/resource/print', [".proplist" => ["uptime", "cpu-load", "free-memory", "total-memory"]]);

        // Check if the system resource data is valid
        if ($systemResource === null) {
            // Return null if system resource data is not valid
            return null;
        }

        // Process the system resource data and get the needed values
        ['uptime' => $uptime, 'freeMemoryPercentage' => $freeMemoryPercentage, 'cpuLoad' => $cpuLoad] = $this->processSystemResource($systemResource[0]);

        // Retrieve active hotspot count
        $activeHotspot = $this->getMikrotikActiveHotspot($ip, $username, $password);

        // Return an array with all the retrieved and processed data
        return [
            'uptime' => $uptime,
            'freeMemoryPercentage' => $freeMemoryPercentage,
            'cpuLoad' => $cpuLoad,
            'activeHotspot' => $activeHotspot
        ];
    }

    /**
     * Process system resource data.
     * @param array $resourceData
     * @return array processed data
     */
    protected function processSystemResource(array $resourceData): array
    {
        $uptime = $resourceData['uptime'] ?? null;
        $freeMemory = $resourceData['free-memory'] ?? null;
        $totalMemory = $resourceData['total-memory'] ?? null;
        $cpuLoad = $resourceData['cpu-load'] ?? null;

        // Calculate the free memory percentage
        $freeMemoryPercentage = $freeMemory && $totalMemory ? number_format(($freeMemory / $totalMemory) * 100, 2) . "%" : null;

        // Parse Mikrotik uptime format to a more common format
        $uptime = $this->parseUptime($uptime);

        // Add a percent sign to the CPU Load percentage before returning
        $cpuLoad .= "%";

        return compact('uptime', 'freeMemoryPercentage', 'cpuLoad');
    }

    /**
     * Parse Mikrotik uptime format to a more common format.
     * @param string|null $uptime
     * @return string
     */
    protected function parseUptime(?string $uptime): string
    {
        if ($uptime) {
            $pattern = "/(?:(\d+)w)?(?:(\d+)d)?(?:(\d+)h)?(?:(\d+)m)?(?:(\d+)s)?/";
            preg_match($pattern, $uptime, $matches);

            $weeks = intval($matches[1] ?? 0);
            $days = intval($matches[2] ?? 0);
            $hours = intval($matches[3] ?? 0);
            $minutes = intval($matches[4] ?? 0);
            $seconds = intval($matches[5] ?? 0);

            // Convert weeks to days
            $days += 7 * $weeks;

            // Construct uptime string in format "dd hh:mm:ss"
            $uptime = sprintf("%dd %02d:%02d:%02d", $days, $hours, $minutes, $seconds);
        }

        return $uptime;
    }

    /**
     * Method to get current upload and download traffic data from a Mikrotik router with CURL.
     * @param string $ip @param string $username @param string $password @param string $interface @return array
     */
    public function getTrafficData($ip, $username, $password, $interface)
    {
        // Set the interface to monitor traffic on (if not set, use the default interface)
        if (!$interface) {
            $interface = env('MIKROTIK_INTERFACE');
        }

        // Monitor the traffic on the interface
        $command    = 'interface/monitor-traffic';
        $data       = [
            "interface" => $interface,
            "once" => "",
            ".proplist" => ["rx-bits-per-second", "tx-bits-per-second"]
        ];
        // Send the request to the monitor traffic endpoint
        $response = $this->model->connectCurl($ip, $username, $password, $command, $data);

        // If the request was not successful, return zero traffic
        if ($response === false || !is_array($response) || empty($response) || isset($response['error']) == 400) {
            // If connection fails, return default values
            return [
                'uploadTraffic' => 0,
                'downloadTraffic' => 0
            ];
        }

        // Get the first item in the response (assuming that the response is an array of items)
        $trafficData = $response[0];
        // Get the traffic data from the response
        $uploadTraffic = isset($trafficData['tx-bits-per-second']) ? $trafficData['tx-bits-per-second'] : 0;
        $downloadTraffic = isset($trafficData['rx-bits-per-second']) ? $trafficData['rx-bits-per-second']  : 0;

        // Return the traffic data
        return [
            'uploadTraffic' => $uploadTraffic,
            'downloadTraffic' => $downloadTraffic
        ];
    }

    /**
     * Retrieves Mikrotik interface data via RouterOS API CURL.
     * @param string $ip Mikrotik router IP address.
     * @param string $username Authentication username.
     * @param string $password Authentication password.
     * @return array|null Mikrotik interface data or null on connection failure.
     */
    public function getMikrotikUserActive($ip, $username, $password)
    {
        try {
            // Establish a connection and retrieve active users data
            $userActive = $this->connectAndRetrieveData($ip, $username, $password, 'ip/hotspot/ip-binding/print', ['count-only' => 'true']);

            // Check if the system resource data is valid
            if ($userActive === null) {
                // Return null if system resource data is not valid
                return null;
            }

            // Establish a connection and retrieve IP bindings data for blocked users
            $ipBindingsBlocked = $this->getIpBindingsCount($ip, $username, $password, 'blocked');
            if ($ipBindingsBlocked === null) {
                Log::error('Failed to connect to Mikrotik router or fetch IP bindings data Blocked: ' . $ip);
                return null;
            }

            // Establish a connection and retrieve IP bindings data for bypassed users
            $ipBindingsBypassed = $this->getIpBindingsCount($ip, $username, $password, 'bypassed');
            if ($ipBindingsBypassed === null) {
                Log::error('Failed to connect to Mikrotik router or fetch IP bindings data Bypassed: ' . $ip);
                return null;
            }
            // Return the counts of active users, bypassed and blocked IP bindings
            return [
                'userActive' => $userActive !== null ? intval($userActive['ret']) : 0,
                'ipBindingBypassed' => intval($ipBindingsBypassed),
                'ipBindingBlocked' => intval($ipBindingsBlocked),
            ];
        } catch (\Exception $e) {
            // If any error occurs, log the error message and return null
            Log::error('Failed to get Mikrotik interface data: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Retrieves the count of IP bindings based on the type.
     * @param string $ip The IP address of the device.
     * @param string $username The username for authentication.
     * @param string $password The password for authentication.
     * @param string $type The type of IP binding (e.g. 'blocked', 'bypassed').
     * @return int The count of IP bindings, or 0 if the connection fails.
     */
    private function getIpBindingsCount($ip, $username, $password, $type)
    {
        // Define the MikroTik API command.
        $command = 'ip/hotspot/ip-binding/print';

        // Define the data for the command (request the count only).
        $data = [
            'count-only' => 'true',
            '.query' => [
                'type=' . $type,
                'disabled=false'
            ]
        ];

        // Establish a connection and retrieve the IP bindings data.
        $ipBindings = $this->model->connectCurl($ip, $username, $password, $command, $data);

        // Return the count of IP bindings, or 0 if the connection failed.
        return $ipBindings !== null ? intval($ipBindings['ret']) : 0;
    }

    /**
     * Handles cURL connections to the Mikrotik router
     * @param string $ip The IP address of the Mikrotik device.
     * @param string $username The username for the Mikrotik device.
     * @param string $password The password for the Mikrotik device.
     * @param string $command The command to execute on the Mikrotik device.
     * @param array $data The data to send with the command.
     * @return array|null Returns the response from the Mikrotik device, or null if the connection fails.
     */
    private function connectAndRetrieveData($ip, $username, $password, $command, $data)
    {
        // Try block for error handling
        try {
            // Using model function to connect to Mikrotik device and retrieve data
            $response = $this->model->connectCurl($ip, $username, $password, $command, $data);

            // Checking if the response is valid
            if ($response === false || !is_array($response) || empty($response) || isset($response['error'])) {
                throw new \Exception("Failed to get data. Empty response or error.");
            }

            // Return the valid response data
            return $response;
        } catch (\Exception $e) {
            // Logging the error message for debugging purposes
            Log::error('Failed to get data: ' . $e->getMessage());

            // Return null on failure
            return null;
        }
    }

}
