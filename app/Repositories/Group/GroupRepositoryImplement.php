<?php

namespace App\Repositories\Group;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Group;
use Yajra\DataTables\Facades\DataTables;

class GroupRepositoryImplement extends Eloquent implements GroupRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Group $model)
    {
        $this->model = $model;
    }


    /**
     * This function retrieves records from a database using a model, initializes the DataTables
     * library, adds an index column and an action column with edit and delete buttons, and returns the
     * DataTables response as a JSON object.
     *
     * @return a JSON response for DataTables.
     */
    public function getDatatables()
    {
        // Retrieve records from the database using the model, including the related 'group' records, and sort by the latest records
        $data = $this->model->latest()->get();

        // Initialize the DataTables library using the fetched data
        $dataTables = DataTables::of($data)
            // Add an index column to the DataTable for easier reference
            ->addIndexColumn()
            // Add a new 'action' column to the DataTable, including edit and delete buttons with their respective icons
            ->addColumn('action', function ($data) {
                // Create an edit button with the record's 'id' as its ID and a 'fas fa-edit' icon
                $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"> <i class="fas fa-edit"></i>&nbsp; Edit</button>';

                // Add a delete button with the record's 'id' as its ID and a 'fas fa-trash' icon
                // TODO: Button delete
                // $button .= '&nbsp;&nbsp;<button type="button" name="edit" id="' . $data->id . '" class="delete btn btn-danger btn-sm"> <i class="fas fa-trash"></i></button>';

                // Return the concatenated button HTML string
                return $button;
            })
            // Create and return the DataTables response as a JSON object
            ->make(true);

        // Return the DataTables JSON response
        return $dataTables;
    }
}
