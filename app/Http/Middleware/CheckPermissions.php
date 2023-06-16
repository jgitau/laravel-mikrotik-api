<?php

namespace App\Http\Middleware;

use App\Services\Setting\SettingService;
use Closure;

class CheckPermissions
{
    protected $settingService;

    /**
     * This is a constructor function that injects a SettingService object into the class.
     * @param SettingService settingService The parameter is an instance of the `SettingService` class.
     */
    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$permissions)
    {
        // Get the permissions for the specified actions from the Setting Service
        $permissions = $this->settingService->getAllowedPermissions($permissions);

        // Check if all permissions are false
        if (!array_filter($permissions)) {
            // If yes, redirect to the permission denied page
            return response()->view('errors.permission-denied', [], 403);
        }

        // If not, add the permissions to the request's attributes for later use
        $request->attributes->set('permissions', $permissions);

        // Continue processing the request
        return $next($request);
    }
}
