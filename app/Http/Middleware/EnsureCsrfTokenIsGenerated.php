<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCsrfTokenIsGenerated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Force generation of CSRF token by accessing csrf_token() helper
        // This ensures the _token is stored in the session before view rendering
        csrf_token();
        
        return $next($request);
    }
}
