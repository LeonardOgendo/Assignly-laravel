<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string    $role  One required role (e.g. 'admin' or 'user')
     * @return \Symfony\Component\HttpFoundation\Response
     */
    
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // If no user is logged in OR the role doesn't match → block.
        if (! $request->user() || $request->user()->role !== $role) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
