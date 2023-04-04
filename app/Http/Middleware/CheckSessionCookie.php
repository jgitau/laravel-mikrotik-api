<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cookie;

class CheckSessionCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check session cookie!
        $sessionKey = Cookie::get('session_key') ?? $this->getQueuedSessionKey();
        $redisKey = '_redis_key_prefix_' . $sessionKey;
        if (!$sessionKey || !Redis::exists($redisKey)) {
            // Sesi or cookie not valid!
            return redirect('')->with('error', 'You are not logged in. Please log in to access the page.');
        }

        return $next($request);
    }

    protected function getQueuedSessionKey()
    {
        // Get all queued cookies
        $queuedCookies = Cookie::getQueuedCookies();
        // Initialize the $sessionKey variable as null
        $sessionKey = null;

        // Iterate through each queued cookie
        foreach ($queuedCookies as $cookie) {
            // Check if the current cookie's name is 'session_key'
            if ($cookie->getName() === 'session_key') {
                // If found, set the $sessionKey variable with the cookie's value
                $sessionKey = $cookie->getValue();
                break;
            }
        }
        // Return the session_key value if found, or null if not found
        return $sessionKey;
    }
}
