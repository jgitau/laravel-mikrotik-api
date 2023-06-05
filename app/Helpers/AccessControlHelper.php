<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;
use App\Models\Page;

class AccessControlHelper
{
    /**
     * Check if the current user's group is allowed to perform a certain action.
     *
     * @param string $action The action to check (e.g. 'add_admin', 'edit_group', etc.)
     * @return bool True if the current user's group is allowed to perform the action, false otherwise.
     */
    public static function isAllowedToPerformAction(string $action): bool
    {
        // Get session key from cookie
        $sessionKey = Cookie::get('session_key');
        $redisKey = '_redis_key_prefix_' . $sessionKey;

        // Get session data from Redis
        $sessionData = Redis::hGetAll($redisKey);
        $groupId = $sessionData['group_id'];

        // Check if this group_id is allowed to perform the action
        $page = Page::where('page', $action)->first();
        if ($page) {
            $allowedGroups = explode(',', $page->allowed_groups);
            return in_array($groupId, $allowedGroups);
        }

        return false;
    }
}
