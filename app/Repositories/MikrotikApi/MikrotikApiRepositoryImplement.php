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

    public function __construct(RouterOsApi $model)
    {
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
    public function getMikrotikUserActive($ip, $username, $password)
    {
        try {
            // Connect to the Mikrotik router. If connection fails, log the error and return null.
            if (!$this->model->connect($ip, $username, $password)) {
                Log::error('Failed to connect to Mikrotik router: ' . $ip);
                return null;
            }

            // Fetch list of active users and IP bindings
            $userActive = $this->model->comm(self::ENDPOINT_ACTIVE);
            $ipBindings = $this->model->comm(self::ENDPOINT_IP_BINDING);

            // Filter bypassed IP bindings
            $ipBindingBypassed = array_filter($ipBindings, function ($binding) {
                return isset($binding['type']) && $binding['type'] === 'bypassed' && isset($binding['disabled']) && $binding['disabled'] === "false";
            });

            // Filter blocked IP bindings
            $ipBindingBlocked = array_filter($ipBindings, function ($binding) {
                return isset($binding['type']) && $binding['type'] === 'blocked' && isset($binding['disabled']) && $binding['disabled'] === "false";
            });

            // Return the counts of active users, bypassed and blocked IP bindings
            return [
                'userActive' => count($userActive),
                'ipBindingBypassed' => count($ipBindingBypassed),
                'ipBindingBlocked' => count($ipBindingBlocked),
            ];
        } catch (\Exception $e) {
            // If any error occurs, log the error message and return null
            Log::error('Failed to get Mikrotik interface data: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Retrieves active hotspot data from a Mikrotik router.
     * @param string $ip The IP address of the Mikrotik router to connect to.
     * @param string $username The username used to authenticate with the Mikrotik router.
     * @param string $password The password credential required to access the Mikrotik router.
     * @return array|null The active hotspot data from the Mikrotik router, or null on error.
     */
    public function getMikrotikActiveHotspot($ip, $username, $password)
    {
        try {
            // Connect to the Mikrotik router. If connection fails, log the error and return null.
            if (!$this->model->connect($ip, $username, $password)) {
                Log::error('Failed to connect to Mikrotik router: ' . $ip);
                return null;
            }

            // Fetch active hotspot data
            $activeHotspot = $this->model->comm("/ip/hotspot/active/print");

            // Return the active hotspot data
            return count($activeHotspot);
        } catch (\Exception $e) {
            // If any error occurs, log the error message and return null
            Log::error('Failed to get Mikrotik active hotspot: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Retrieves Mikrotik resource data via RouterOS API.
     * @param string $ip Mikrotik router IP address.
     * @param string $username Authentication username.
     * @param string $password Authentication password.
     * @return array|null Mikrotik resource data or null on connection failure.
     */
    public function getMikrotikResourceData($ip, $username, $password)
    {
        try {
            // Connect to the Mikrotik router. If connection fails, log the error and return null.
            if (!$this->model->connect($ip, $username, $password)) {
                Log::error('Failed to connect to Mikrotik router: ' . $ip);
                return null;
            }

            // Fetch system resource data
            $systemResource = $this->model->comm(self::ENDPOINT_RESOURCE);

            if (empty($systemResource[0])) {
                Log::error('Failed to get Mikrotik resource data: Empty response.');
                return null;
            }

            // Extract the data from the response
            ['uptime' => $uptime, 'freeMemoryPercentage' => $freeMemoryPercentage, 'cpuLoad' => $cpuLoad] = $this->processSystemResource($systemResource[0]);

            // Fetch active hotspot data
            $activeHotspot = $this->getMikrotikActiveHotspot($ip, $username, $password);

            return [
                'uptime' => $uptime,
                'freeMemoryPercentage' => $freeMemoryPercentage,
                'cpuLoad' => $cpuLoad,
                'activeHotspot' => $activeHotspot,
            ];
        } catch (\Exception $e) {
            // If any error occurs, log the error message and return null
            Log::error('Failed to get Mikrotik resource data: ' . $e->getMessage());
            return null;
        }
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
     * Method to get current upload and download traffic data from a Mikrotik router.
     * @param string $ip @param string $username @param string $password @param string $interface @return array
     */
    public function getTrafficData($ip, $username, $password, $interface = "ether2-wan")
    {
        // Connect to the Mikrotik router
        if (!$this->model->connect($ip, $username, $password)) {
            // If connection fails, return default values
            return [
                'uploadTraffic' => 0,
                'downloadTraffic' => 0
            ];
        }

        // Send the request to the monitor traffic endpoint
        $response = $this->model->comm(self::ENDPOINT_MONITOR_TRAFFIC, [
            "interface" => $interface,
            "once" => ""
        ]);

        if (isset($response[0])) {
            // Get the traffic data
            $trafficData = $response[0];

            $uploadTraffic = isset($trafficData['tx-bits-per-second']) ? round($trafficData['tx-bits-per-second'] / 1000) : 0;
            $downloadTraffic = isset($trafficData['rx-bits-per-second']) ? round($trafficData['rx-bits-per-second'] / 1000) : 0;

            return [
                'uploadTraffic' => $uploadTraffic ,
                'downloadTraffic' => $downloadTraffic
            ];
        }

        return [
            'uploadTraffic' => 0,
            'downloadTraffic' => 0
        ];
    }




}
