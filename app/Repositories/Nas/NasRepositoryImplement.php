<?php

namespace App\Repositories\Nas;

use App\Libraries\Tiny;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Nas;
use App\Models\Setting;

class NasRepositoryImplement extends Eloquent implements NasRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;
    protected $setting;
    protected $tiny;

    public function __construct(Nas $model, Setting $setting, Tiny $tiny)
    {
        $this->model = $model;
        $this->setting = $setting;
        $this->tiny = $tiny; // Save instance Tiny
    }

    public function setupProcess($record, $data)
    {

        if ($record->server_ip_address != $data['serverIP']) {
            $reset = $data;
            $reset['serverIP'] = $record->server_ip_address;

            // dd(json_encode($reset));
            $rep = $this->tiny->postJson('/system/reset_radius', json_encode($reset));
            if (!empty($rep['error'])) {
                return $rep['error'];
            }
        }

        $body = json_encode($data);
        $reply = $this->tiny->postJson('/system/setup', $body);

        if (!empty($reply['status_code']) && $reply['status_code'] == 201) {
            return true;
        }

        if (!empty($reply['error'])) {
            return $reply['error'];
        }

        return json_decode($reply['body']);
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
        $mikrotik_ip = $this->getSetting('mikrotik_ip', '0');
        $mikrotik_api_port = $this->getSetting('mikrotik_api_port', '0');
        $server_ip = $this->getSetting('server_ip', '0');

        // Assign the retrieved settings to the NAS record properties
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
        $this->setting->where('module_id', $moduleId)
            ->where('setting', $settingName)
            ->update(['value' => $value]);
        return $this->setting->getAffectedRows();
    }

}
