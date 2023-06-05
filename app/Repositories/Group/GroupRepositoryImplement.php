<?php

namespace App\Repositories\Group;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Group;
use App\Models\Module;
use App\Models\Page;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Yajra\DataTables\Facades\DataTables;

class GroupRepositoryImplement extends Eloquent implements GroupRepository
{

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
     * Fetches data from Redis, queries Group model, and generates a DataTables table.
     * Edit and delete buttons are added based on the user's group permissions.
     *
     * @return DataTables instance with query on "groups" table, sorted by latest.
     * The "action" column includes edit and delete buttons based on group permissions.
     * Buttons are kept raw (not escaped). DataTables instance is returned as JSON.
     */
    public function getDatatables()
    {
        // Get session key from cookie
        $sessionKey = Cookie::get('session_key');
        $redisKey = '_redis_key_prefix_' . $sessionKey;

        // Get session data from Redis
        $sessionData = Redis::hGetAll($redisKey);
        $groupId = $sessionData['group_id'];

        // Query the Group model
        $query = $this->model->select('groups.*')->latest();

        return Datatables::of($query)
            ->addIndexColumn()
            ->editColumn('action', function ($row) use ($groupId) {
                // Query the pages table to get all allowed groups
                $editGroupPage = Page::where('page', 'edit_group')->first();
                $deleteGroupPage = Page::where('page', 'delete_group')->first();

                $editButton = '';
                $deleteButton = '';

                // Check if this group_id is allowed to edit
                if ($editGroupPage) {
                    $allowedGroups = explode(',', $editGroupPage->allowed_groups);
                    if (in_array($groupId, $allowedGroups)) {
                        // If group is allowed, show edit button
                        $editButton = '<a href="' . route('backend.setup.admin.edit-group', $row->id) . '" class="btn btn-primary btn-sm"> <i class="fas fa-edit"></i>&nbsp; Edit</a>';
                    }
                }

                // Check if this group_id is allowed to delete
                if ($deleteGroupPage) {
                    $allowedGroups = explode(',', $deleteGroupPage->allowed_groups);
                    if (in_array($groupId, $allowedGroups)) {
                        // If group is allowed, show delete button
                        $deleteButton = '&nbsp;&nbsp;<button type="button" class="delete btn btn-danger btn-sm" onclick="confirmDeleteGroup(\'' . $row->id . '\')"> <i class="fas fa-trash"></i>&nbsp; Delete</button>';
                    }
                }

                return $editButton . $deleteButton;
            })
            ->rawColumns(['action']) // Make sure your buttons won't be escaped
            ->make(true);
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
            ->select('id', 'title', 'allowed_groups')
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
     * Retrieves data from 'groups' and 'pages' tables based on group ID.
     * @param groupId The group's ID.
     * @return array Contains 'groupData' (data for the group) and 'pageIds' (IDs of allowed pages for the group).
     */
    public function getGroupAndPagesById($groupId)
    {
        // Initialize return array
        $groupAndPagesData = [];

        // Query 'groups' table where 'id' is $groupId
        $groupData = $this->model->find($groupId);

        // If groupData returns a result
        if ($groupData) {
            // Save group data to groupAndPagesData array
            $groupAndPagesData['groupData'] = $groupData;

            // Query 'pages' table, select 'id' and 'allowed_groups' columns
            $pageDataQuery = Page::select('id', 'allowed_groups as ag')->get();

            // If pageDataQuery returns results
            if ($pageDataQuery->count() > 0) {
                $pageIdsArray = [];

                // Loop through pageDataQuery results
                foreach ($pageDataQuery as $pageData) {
                    // Convert 'ag' column to array
                    $allowedGroupsArray = explode(',', $pageData->ag);

                    // If $groupId is in $allowedGroupsArray
                    if (in_array($groupId, $allowedGroupsArray)) {
                        // Add page 'id' to $pageIdsArray
                        $pageIdsArray[] = $pageData->id;
                    }
                }

                // Save pageIdsArray to groupAndPagesData array
                $groupAndPagesData['pageIds'] = $pageIdsArray;
            } else {
                $groupAndPagesData['pageIds'] = false;
            }
        } else {
            $groupAndPagesData['groupData'] = false;
        }

        // Return groupAndPagesData array
        return $groupAndPagesData;
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

    /**
     * Updates an existing group and its page permissions.
     * @param string $groupName New group name.
     * @param array $permissions Page permissions, keyed by page ID.
     * @param int $id ID of the group to be updated.
     *
     * @return mixed Returns Group instance on success, Exception on failure.
     * @throws Exception if unable to update Group or permissions.
     */
    public function updateGroup($groupName, $permissions, $id)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Find Group by id
            $group = $this->model->findOrFail($id);

            // Update Group name
            $group->name = trim($groupName);
            $group->save();

            // Get all pages
            $pages = Page::all();

            // Loop through the pages
            foreach ($pages as $page) {
                $allowedGroups = explode(',', $page->allowed_groups);
                // If the permission for this page is set to "1" or if the page id is "1"
                if (isset($permissions[$page->id]) && $permissions[$page->id] == '1' || $page->id == '1') {
                    // If the group id is not in the allowed groups
                    if (!in_array($group->id, $allowedGroups)) {
                        // Add the group id to the allowed groups
                        $allowedGroups[] = $group->id;
                    }
                } else {
                    // If the group id is in the allowed groups and the permission is not "1", remove it
                    if (($key = array_search($group->id, $allowedGroups)) !== false) {
                        unset($allowedGroups[$key]);
                    }
                }

                // Update the page
                $page->allowed_groups = implode(',', $allowedGroups);
                $page->save();
            }

            // Commit the transaction
            DB::commit();

            // Return the updated group
            return $group;
        } catch (\Exception $e) {
            // If something goes wrong, rollback the transaction
            DB::rollback();

            // Return the exception
            return $e;
        }
    }
}
