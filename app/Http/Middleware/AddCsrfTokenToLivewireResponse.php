<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddCsrfTokenToLivewireResponse
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($request->header('X-Livewire')) {
            $token = csrf_token();
            $response->header('X-CSRF-TOKEN', $token);
        }

        return $response;
    }
}
