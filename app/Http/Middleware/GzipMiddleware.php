<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GzipMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Check if client accepts gzip encoding
        if (strpos($request->header('Accept-Encoding'), 'gzip') === false) {
            return $response;
        }

        // Compress response content
        $response->setContent(gzencode($response->getContent(), 9));

        // Set appropriate response headers
        $response->header('Content-Encoding', 'gzip');
        $response->header('Vary', 'Accept-Encoding');

        return $response;
    }
}
