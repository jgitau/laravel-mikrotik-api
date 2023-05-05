<?php

namespace App\Repositories\Config\UserData;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Setting;

class UserDataRepositoryImplement extends Eloquent implements UserDataRepository
{

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
     * getUserDataParameters
     *
     * @return void
     */
    public function getUserDataParameters()
    {
        // Get 2 line from setting table based on setting
        $usersData = $this->model->whereIn(
            'setting',
            [
                // COLUMNS
                'id_column',
                'name_column',
                'email_column',
                'phone_number_column',
                'room_number_column',
                'date_column',
                'first_name_column',
                'last_name_column',
                'mac_column',
                'location_column',
                'gender_column',
                'birthday_column',
                'login_with_column',
                // DISPLAYS
                'display_id',
                'display_name',
                'display_email',
                'display_phone_number',
                'display_room_number',
                'display_date',
                'display_first_name',
                'display_last_name',
                'display_mac',
                'display_location',
                'display_gender',
                'display_birthday',
                'display_login_with'
            ]
        )->get();

        return $usersData;
    }

    /**
     * updateUserDataSettings
     *
     * @param  mixed $settings
     * @return void
     */
    public function updateUserDataSettings($settings)
    {
        foreach ($settings as $key => $value) {
            $this->model->updateOrCreate(
                ['setting' => $key],
                ['value' => $value]
            );
        }
    }
}
