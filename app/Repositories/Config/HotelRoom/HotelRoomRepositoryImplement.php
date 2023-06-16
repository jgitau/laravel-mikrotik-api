<?php

namespace App\Repositories\Config\HotelRoom;

use App\Models\Services;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Setting;
use Yajra\DataTables\Facades\DataTables;

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

    /**
     * getDatatables
     */
    public function getDatatables()
    {
        // Retrieve records from the database using the model, including the related 'Services' records, and sort by the latest records
        $data = Services::select('id','service_name', 'cron_type', 'cron')
        ->where('cron_type', '!=', null)
        ->where('cron', '!=', '')
        ->where('cron', '!=', 0)
        ->get();

        // Initialize the DataTables library using the fetched data
        $dataTables = DataTables::of($data)
            // Add an index column to the DataTable for easier reference
            ->addIndexColumn()
            // Add a new 'action' column to the DataTable, including edit and delete buttons with their respective icons
            ->addColumn('action', function ($data) {
                // Create an edit button with the record's 'id' as its ID and a 'fas fa-edit' icon
                // $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"> <i class="fas fa-edit"></i>&nbsp; Edit</button>';

                // Add a delete button with the record's 'id' as its ID and a 'fas fa-trash' icon
                $button = '&nbsp;&nbsp;<button type="button" name="edit" class="delete btn btn-danger btn-sm" onclick="confirmDeleteService(\'' . $data->id . '\')"> <i class="fas fa-trash"></i>&nbsp; Delete</button>';

                // Return the concatenated button HTML string
                return $button;
            })
            // Create and return the DataTables response as a JSON object
            ->make(true);

        // Return the DataTables JSON response
        return $dataTables;
    }



}
