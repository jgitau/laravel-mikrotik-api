<?php

namespace App\Repositories\Nas;

use App\Libraries\Tiny;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Nas;
use App\Models\RouterOsApi;
use App\Models\Setting;

class NasRepositoryImplement extends Eloquent implements NasRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;
    protected $setting;
    protected $routerOsApi;
    const AUTHENTICATION_PORT = 1812;
    const ACCOUNTING_PORT = 1813;
    const TIMEOUT = 30;

    public function __construct(Nas $model, Setting $setting, RouterOsApi $routerOsApi)
    {
        $this->model = $model;
        $this->setting = $setting;
        $this->routerOsApi = $routerOsApi;
    }


    /**
     * The function sets up a process by connecting to a Mikrotik device, adding RADIUS configuration,
     * creating a user group and user, and returning the result of the operation.
     *
     * @param record It is a variable that contains the current record or data of a user in the system.
     * It is used to check if the server IP address has changed or not.
     * @param data The  parameter is an array that contains input data required for the setup
     * process. It includes the temporary username and password, Mikrotik IP address, RADIUS server IP
     * address, and RADIUS secret.
     *
     * @return an array with two keys: 'status' and 'message'. The 'status' key indicates whether the
     * setup process was successful or not, and the 'message' key provides additional information about
     * the status of the process.
     */
    public function setupProcess($record, $data)
    {
        // Initialize the result array
        $result = [
            'status' => false,
            'message' => ''
        ];

        // Check if the server IP address has changed
        if ($record->server_ip_address != $data['serverIP']) {
            // Extract required data from the input
            $username = $data['tempUsername'];
            $password = $data['tempPassword'];
            $ipAdress = $data['mikrotikIP'];
            $radiusServer   = $data['mikrotikIP'];
            $radiusSecret   = $data['radiusSecret'];

            try {
                // Attempt to connect to the Mikrotik device
                if ($this->routerOsApi->connect($ipAdress, $username, $password)) {
                    // Add RADIUS configuration and check if successful
                    $radiusResult = $this->addRadiusConfiguration($radiusServer, $radiusSecret);
                    if ($radiusResult['status']) {
                        // Create user group and check if successful
                        $groupResult = $this->createUserGroup();
                        if ($groupResult['status']) {
                            // Create user and check if successful
                            $userResult = $this->createUser();
                            if ($userResult['status']) {
                                // If all operations are successful, update the result status
                                $result['status'] = true;
                            } else {
                                // Set error message for user creation
                                $result['message'] = $userResult['message'];
                            }
                        } else {
                            // Set error message for group creation
                            $result['message'] = $groupResult['message'];
                        }
                    } else {
                        // Set error message for RADIUS configuration
                        $result['message'] = $radiusResult['message'];
                    }
                } else {
                    // Set error message if unable to connect to Mikrotik device
                    $result['message'] = "Unable to connect to the Mikrotik device.";
                }
            } catch (\Exception $e) {
                // Set error message if an exception occurs
                $result['message'] = "Error: " . $e->getMessage();
            }
        }

        // Return the result of the operation
        return $result;
    }


    /**
     * The function adds a RADIUS configuration to a router using the RouterOS API.
     *
     * @param radiusServer The IP address or hostname of the RADIUS server to be added as a
     * configuration.
     * @param radiusSecret The secret key used for RADIUS authentication between the router and the
     * RADIUS server.
     *
     * @return An array with two keys: 'status' and 'message'. The 'status' key indicates whether the
     * operation was successful or not, and the 'message' key contains an error message if the
     * operation was not successful.
     */
    public function addRadiusConfiguration($radiusServer, $radiusSecret)
    {
        // Initialize the result array
        $result = [
            'status' => false,
            'message' => ''
        ];

        // Fetch existing RADIUS configurations
        $radiusConfigs = $this->routerOsApi->comm("/radius/print");

        // Remove each RADIUS configuration found
        foreach ($radiusConfigs as $config) {
            $this->routerOsApi->comm("/radius/remove", array(".id" => $config[".id"]));
        }

        // Add new RADIUS configuration
        $addResult = $this->routerOsApi->comm("/radius/add", array(
            "address"               => $radiusServer,
            "secret"                => $radiusSecret,
            "domain"                => "megalos",
            "service"               => "hotspot",
            "authentication-port"   => self::AUTHENTICATION_PORT,
            "accounting-port"       => self::ACCOUNTING_PORT,
            "timeout"               => self::TIMEOUT,
            "comment"               => "managed by AZMI. DO NOT EDIT!!!"
        ));

        // Check if the RADIUS configuration addition was successful
        if (isset($addResult['!re']) && $addResult['!re'] === 0) {
            $result['status'] = true;
        } else {
            // Check if there is an error message
            if (isset($addResult['!trap'])) {
                // Set the result to error if there is an error message
                $result['message'] = "Error in adding RADIUS configuration: " . $addResult['!trap'][0]['message'];
            } else {
                // If there is no error message, consider the operation successful
                $result['status'] = true;
            }
        }

        return $result;
    }

    /**
     * The function creates a new user group with specific policies and returns a result indicating
     * success or failure.
     *
     * @return an array with two keys: 'status' and 'message'. The 'status' key indicates whether the
     * user group creation was successful or not, and the 'message' key contains an error message if
     * the creation was not successful.
     */
    public function createUserGroup()
    {
        // Initialize the result array
        $result = [
            'status' => false,
            'message' => ''
        ];

        // Create the new group with the required policies
        $groupResult = $this->routerOsApi->comm("/user/group/add", array(
            "name"     => "megalos",
            "policy"   => "write,policy,read,test,api",
            "comment"  => "managed by AZMI. DO NOT EDIT!!!"
        ));

        // Check if the group creation was successful
        if (isset($groupResult['!re']) && $groupResult['!re'] === 0) {
            $result['status'] = true;
        } else {
            // Handle errors during group creation
            if (isset($groupResult['!trap'])) {
                $result['message'] = "Error in adding user group: " . $groupResult['!trap'][0]['message'];
            } else {
                $result['status'] = true;
            }
        }

        return $result;
    }

    /**
     * The function creates a new user with a specified username, password, and group, and returns a
     * result array indicating whether the creation was successful or not.
     *
     * @return an array with two keys: 'status' and 'message'. The 'status' key indicates whether the
     * user creation was successful or not, and the 'message' key contains an error message if the user
     * creation was not successful.
     */
    public function createUser()
    {
        // Initialize the result array
        $result = [
            'status' => false,
            'message' => ''
        ];

        // Add the new user with the specified username, password, and group
        $userResult = $this->routerOsApi->comm("/user/add", array(
            "name"     => "megalos",
            "password" => "megalos",
            "group"    => "megalos",
            "comment"  => "managed by AZMI. DO NOT EDIT!!!"
        ));

        // Check if the user creation was successful
        if (isset($userResult['!re']) && $userResult['!re'] === 0) {
            $result['status'] = true;
        } else {
            // Handle errors during user creation
            if (isset($userResult['!trap'])) {
                $result['message'] = "Error in adding user: " . $userResult['!trap'][0]['message'];
            } else {
                $result['status'] = true;
            }
        }

        return $result;
    }


    /**
     * Get NAS by its shortname
     *
     * @param string $shortName
     * @return Nas|null
     */
    public function getNasByShortname($shortName)
    {
        return $this->model->where('shortname', $shortName)->first();
    }

    /**
     * Retrieve NAS parameters for the given shortname
     *
     * @return Nas|null
     */
    public function getNasParameters()
    {
        // Retrieve NAS record by its shortname
        $record = $this->getNasByShortname('megalos');

        // Get settings for mikrotik_ip, mikrotik_api_port, and server_ip
        $mikrotik_api_username = $this->getSetting('mikrotik_api_username', '0');
        $mikrotik_ip = $this->getSetting('mikrotik_ip', '0');
        $mikrotik_api_port = $this->getSetting('mikrotik_api_port', '0');
        $server_ip = $this->getSetting('server_ip', '0');

        // Assign the retrieved settings to the NAS record properties
        $record->mikrotik_api_username = $mikrotik_api_username;
        $record->mikrotik_ip_address = $mikrotik_ip;
        $record->mikrotik_api_port = $mikrotik_api_port;
        $record->server_ip_address = $server_ip;
        return $record;
    }

    /**
     * Edit NAS process (updating NAS table and mikrotik API parameters)
     *
     * @param array $data
     * @return bool
     */
    public function editNasProcess($data)
    {
        try {
            $this->_updateNasTable($data);
            $this->_editMikrotikApiParameters($data);
        } catch (\Exception $e) {
            return $e->getMessage(); // Return the error message on failure
        }

        return true; // Return true on success
    }

    /**
     * Update NAS table with the given data
     *
     * @param array $data
     * @return void
     */
    private function _updateNasTable($data)
    {
        $nas = array(
            'ports' => $data['radiusPort'],
            'secret' => $data['radiusSecret']
        );
        $this->model->where('id', $data['id'])->update($nas);
    }

    /**
     * Edit Mikrotik API parameters with the given data
     *
     * @param array $data
     * @return void
     */
    private function _editMikrotikApiParameters($data)
    {
        $this->updateSetting('mikrotik_ip', '0', $data['mikrotikIP']);
        $this->updateSetting('mikrotik_api_port', '0', $data['mikrotikAPIPort']);
        $this->updateSetting('server_ip', '0', $data['serverIP']);
        $this->updateSetting('mikrotik_api_username', '0', $data['username']);
        $this->updateSetting('mikrotik_api_password', '0', $data['password']);
    }

    /**
     * Retrieve the setting value based on the setting name and module ID
     *
     * @param string $settingName
     * @param int $moduleId
     * @return mixed
     */
    public function getSetting($settingName, $moduleId)
    {
        $query = $this->setting
            ->where('module_id', $moduleId)
            ->where('setting', $settingName)
            ->first();
        return (!empty($query->value)) ? $query->value : "";
    }

    /**
     * Update the setting value based on the setting name, module ID, and new value
     *
     * @param string $settingName
     * @param int $moduleId
     * @param mixed $value
     * @return int
     */
    public function updateSetting($settingName, $moduleId, $value)
    {
        $affectedRows = $this->setting->where('module_id', $moduleId)
            ->where('setting', $settingName)
            ->update(['value' => $value]);

        return $affectedRows;
    }
}
