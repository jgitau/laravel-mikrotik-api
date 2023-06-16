<?php

namespace App\Http\Middleware;

use App\Services\Setting\SettingService;
use Closure;
use Illuminate\Http\Request;

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
        $permissions = $this->settingService->getAllowedPermissions($permissions);

        if (!array_filter($permissions)) {
            // If all permissions are false, redirect to the permission denied page
            return response()->view('errors.permission-denied', [], 403);
        }

        $request->attributes->set('permissions', $permissions);

        return $next($request);
    }
}
