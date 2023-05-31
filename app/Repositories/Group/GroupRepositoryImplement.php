<?php

namespace App\Repositories\Group;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Group;
use App\Models\Module;
use App\Models\Page;
use Illuminate\Support\Facades\DB;
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

    /**
     * Retrieves active page permissions, ordered by module ID and page ID.
     *
     * @return Collection of pages with associated module titles and IDs.
     */
    public function getDataPermissions()
    {
        $data = Page::with('module')
            ->whereHas('module', function ($query) {
                $query->where('root', '!=', 1);
                $query->where('active', 1);
            })
            ->select('id', 'title')
            ->addSelect([
                'mod_title' => Module::select('title')
                    ->whereColumn('id', 'pages.module_id')
            ])
            ->orderBy('module_id', 'asc')
            ->orderBy('id', 'asc')
            ->get();
        return $data;
    }

    /**
     * Creates a new group and updates page permissions.
     * @param string $groupName Group name.
     * @param array $permissions Page permissions, keyed by page ID.
     *
     * @return mixed Returns Group instance on success, Exception on failure.
     * @throws Exception if unable to create Group or update permissions.
     */
    public function storeNewGroup($groupName, $permissions)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create Group
            $group = $this->model->create([
                'name' => trim($groupName),
            ]);

            // Get all pages
            $pages = Page::all();

            // Loop through the pages
            foreach ($pages as $page) {
                $allowedGroups = explode(',', $page->allowed_groups);
                // If the permission for this page is set to "1" or if the page id is "1"
                if ($permissions[$page->id] == '1' || $page->id == '1') {
                    // If the group id is not in the allowed groups
                    if (!in_array($group->id, $allowedGroups)) {
                        // Add the group id to the allowed groups
                        $allowedGroups[] = $group->id;
                        // Update the page
                        $page->allowed_groups = implode(',', $allowedGroups);
                        $page->save();
                    }
                }
            }

            // Commit the transaction
            DB::commit();

            // Return the created group
            return $group;
        } catch (\Exception $e) {
            // If something goes wrong, rollback the transaction
            DB::rollback();

            // Return the exception
            return $e;
        }
    }

}
