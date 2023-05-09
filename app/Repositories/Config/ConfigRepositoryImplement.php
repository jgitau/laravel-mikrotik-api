<?php

namespace App\Repositories\Config;

use App\Models\Module;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Setting;
use Yajra\DataTables\Facades\DataTables;

class ConfigRepositoryImplement extends Eloquent implements ConfigRepository
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
     * getDatatables
     */
    public function getDatatables()
    {
        // Use Eloquent to retrieve data from the database
        $flagModules = $this->model
            ->select('flag_module')
            ->whereNotNull('flag_module')
            ->groupBy('flag_module')
            ->get()
            ->pluck('flag_module');

        // Retrieve module data with matching flag_modules
        $data = Module::select('name', 'title', 'id')
            ->whereIn('name', $flagModules)
            ->get();

        // Get the raw data and convert it to an array
        $rawData = $data->toArray();

        // Add the 'Router' row to the end of the rawData array
        $rawData[] = [
            'id' => -1, // Set an arbitrary negative ID to distinguish it from real records
            'title' => 'Router',
            'name' => 'edit_router'
        ];



        // Initialize DataTables using the rawData array
        $dataTables = DataTables::of($rawData)
            // Add an index column to the DataTable for easier reference
            ->addIndexColumn()
            // Add a new 'action' column to the DataTable, including edit and delete buttons with their respective icons
            ->addColumn('action', function ($data) {
                if ($data['id'] > 0) {
                    // For non-Router rows, use the edit and delete buttons with Names and classes
                    if($data['name'] == 'hotel_rooms') {
                        $routeDetailHotelRooms = route('backend.setup.config.hotel_rooms');
                        $button = '<a href="' . $routeDetailHotelRooms . '" aria-label="Detail Button" name="' . $data['name'] . '" class="edit btn btn-info btn-sm"> <i class="fas fa-eye"></i></a>';
                        $button .= '&nbsp;&nbsp;<button type="button" aria-label="Edit Button" name="' . $data['name'] . '" class="edit btn btn-primary btn-sm" onclick="showModalByName(\'' . $data['name'] . '\')"> <i class="fas fa-edit"></i></button>';
                    }else{
                        $button = '<button type="button" aria-label="Edit Button" name="' . $data['name'] . '" class="edit btn btn-primary btn-sm" onclick="showModalByName(\'' . $data['name'] . '\')"> <i class="fas fa-edit"></i></button>';
                    }
                } else {
                    $button = '<button type="button" aria-label="Edit Button" name="edit_router" class="edit btn btn-primary btn-sm" onclick="showModalByName(\'edit_router\')"> <i class="fas fa-edit"></i></button>';
                }
                return $button;
            })
            // Create and return the DataTables response as a JSON object
            ->make(true);

        // Return the DataTables JSON response
        return $dataTables;
    }
}
