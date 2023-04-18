<?php

namespace App\Repositories\Config\Client;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Setting;

class ClientRepositoryImplement extends Eloquent implements ClientRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    /**
     * getClientParameters
     *
     * @return void
     */
    public function getClientParameters()
    {
        // Get 2 line from setting table based on setting
        $settings = $this->model->whereIn('setting', ['clients_vouchers_printer', 'create_vouchers_type'])->get();

        return $settings;
    }


    /**
     * updateClientSettings
     *
     * @param  mixed $settings
     * @return void
     */
    public function updateClientSettings($settings)
    {
        foreach ($settings as $key => $value) {
            $this->model->updateOrCreate(
                ['setting' => $key],
                ['value' => $value]
            );
        }
    }
}
