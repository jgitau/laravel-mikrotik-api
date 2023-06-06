<?php

namespace App\Repositories\MikrotikApi;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\RouterOsApi;
use Illuminate\Support\Facades\Log;

class MikrotikApiRepositoryImplement extends Eloquent implements MikrotikApiRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(RouterOsApi $model)
    {
        $this->model = $model;
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
            $userActive = $this->model->comm("/ip/hotspot/active/print");
            $ipBindings = $this->model->comm("/ip/hotspot/ip-binding/print");

            // Filter bypassed IP bindings
            $ipBindingBypassed = array_filter($ipBindings, function ($binding) {
                return isset($binding['type']) && $binding['type'] === 'bypassed';
            });

            // Filter blocked IP bindings
            $ipBindingBlocked = array_filter($ipBindings, function ($binding) {
                return isset($binding['type']) && $binding['type'] === 'blocked';
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
     * Retrieves the CPU load percentage from a Mikrotik router.
     * @param string $ip The IP address of the Mikrotik router to connect to.
     * @param string $username The username used to authenticate with the Mikrotik router.
     * @param string $password The password credential required to access the Mikrotik router.
     * @return int|null The CPU load percentage of the Mikrotik router, or null on error.
     */
    public function getMikrotikCpuLoad($ip, $username, $password)
    {
        try {
            // Connect to the Mikrotik router. If connection fails, log the error and return null.
            if (!$this->model->connect($ip, $username, $password)) {
                Log::error('Failed to connect to Mikrotik router: ' . $ip);
                return null;
            }

            // Fetch CPU Load data
            $cpuLoad = $this->model->comm("/system/resource/print");

            // Extract the CPU Load percentage from the response
            $cpuLoadPercentage = isset($cpuLoad[0]['cpu-load']) ? $cpuLoad[0]['cpu-load'] : null;

            // Add a percent sign to the CPU Load percentage before returning
            $cpuLoadPercentage .= "%";

            // Return the CPU Load percentage
            return $cpuLoadPercentage;
        } catch (\Exception $e) {
            // If any error occurs, log the error message and return null
            Log::error('Failed to get Mikrotik CPU Load: ' . $e->getMessage());
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
     * Retrieves the free memory percentage from a Mikrotik router.
     * @param string $ip The IP address of the Mikrotik router to connect to.
     * @param string $username The username used to authenticate with the Mikrotik router.
     * @param string $password The password credential required to access the Mikrotik router.
     * @return string|null The free memory percentage of the Mikrotik router, or null on error.
     */
    public function getMikrotikFreeMemoryPercentage($ip, $username, $password)
    {
        try {
            // Connect to the Mikrotik router. If connection fails, log the error and return null.
            if (!$this->model->connect($ip, $username, $password)) {
                Log::error('Failed to connect to Mikrotik router: ' . $ip);
                return null;
            }

            // Fetch system resource data
            $systemResource = $this->model->comm("/system/resource/print");

            // Check if free-memory and total-memory exist in the response
            if (isset($systemResource[0]['free-memory']) && isset($systemResource[0]['total-memory'])) {
                // Calculate the free memory percentage
                $freeMemoryPercentage = ($systemResource[0]['free-memory'] / $systemResource[0]['total-memory']) * 100;

                // Format the percentage to have 2 decimal places and add a percent sign
                $freeMemoryPercentage = number_format($freeMemoryPercentage, 2) . "%";

                // Return the free memory percentage
                return $freeMemoryPercentage;
            } else {
                Log::error('Failed to calculate Mikrotik free memory percentage: free-memory or total-memory not found in response.');
                return null;
            }
        } catch (\Exception $e) {
            // If any error occurs, log the error message and return null
            Log::error('Failed to get Mikrotik free memory percentage: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Fetches the uptime of a Mikrotik router given its IP, username, and password.
     * @param string $ip IP address of the Mikrotik router.
     * @param string $username Router's username for authentication.
     * @param string $password Router's password for authentication.
     * @return string|null Uptime of the router if successful, else null.
     */
    public function getMikrotikUptime($ip, $username, $password)
    {
        try {
            // Connect to the Mikrotik router. If connection fails, log the error and return null.
            if (!$this->model->connect($ip, $username, $password)) {
                Log::error('Failed to connect to Mikrotik router: ' . $ip);
                return null;
            }

            // Fetch system resource data
            $systemResource = $this->model->comm("/system/resource/print");

            // Check if uptime exists in the response
            if (isset($systemResource[0]['uptime'])) {
                // Extract uptime from the response
                $uptime = $systemResource[0]['uptime'];

                // Parse Mikrotik uptime format to a more common format
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

                return $uptime;
            } else {
                Log::error('Failed to get Mikrotik uptime: uptime not found in response.');
                return null;
            }
        } catch (\Exception $e) {
            // If any error occurs, log the error message and return null
            Log::error('Failed to get Mikrotik uptime: ' . $e->getMessage());
            return null;
        }
    }


    // TODO:
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
            $systemResource = $this->model->comm("/system/resource/print");

            // Check if uptime and free-memory exist in the response
            if (isset($systemResource[0]['uptime']) && isset($systemResource[0]['free-memory'])) {
                // Extract uptime from the response
                $uptime = $systemResource[0]['uptime'];

                // Parse Mikrotik uptime format to a more common format
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

                // Calculate the free memory percentage
                $freeMemoryPercentage = ($systemResource[0]['free-memory'] / $systemResource[0]['total-memory']) * 100;

                // Format the percentage to have 2 decimal places and add a percent sign
                $freeMemoryPercentage = number_format($freeMemoryPercentage, 2) . "%";

                return [
                    'uptime' => $uptime,
                    'freeMemoryPercentage' => $freeMemoryPercentage,
                ];
            } else {
                Log::error('Failed to get Mikrotik resource data: uptime or free-memory not found in response.');
                return null;
            }
        } catch (\Exception $e) {
            // If any error occurs, log the error message and return null
            Log::error('Failed to get Mikrotik resource data: ' . $e->getMessage());
            return null;
        }
    }



}
