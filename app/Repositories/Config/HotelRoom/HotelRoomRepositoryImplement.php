<?php

namespace App\Repositories\Config\HotelRoom;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Setting;

class HotelRoomRepositoryImplement extends Eloquent implements HotelRoomRepository{

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
     * getHotelRoomParameters
     *
     * @return void
     */
    public function getHotelRoomParameters()
    {
        // Get 2 line from setting table based on setting
        $settings = $this->model->whereIn('setting', ['hms_connect'])->firstOrFail();

        return $settings;
    }

    /**
     * updateHotelRoomSettings
     *
     * @param  mixed $settings
     * @return void
     */
    public function updateHotelRoomSettings($settings)
    {
        foreach ($settings as $key => $value) {
            $this->model->updateOrCreate(
                ['setting' => $key],
                ['value' => $value]
            );
        }
    }

}
