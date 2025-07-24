<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        // Determine which login route to redirect to based on the URL path
        $path = $request->path();
        
        if (str_starts_with($path, 'designer/') || $path === 'designer') {
            return route('designer.login');
        } elseif (str_starts_with($path, 'buyer/') || $path === 'buyer') {
            return route('buyer.login');
        }
        
        // Default fallback - redirect to buyer login for any unmatched routes
        return route('buyer.login');
    }
}
