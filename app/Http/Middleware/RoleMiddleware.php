<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$accepted_role)
    {
        $role = auth()->user()->role;
        if (!in_array($role, $accepted_role)) return abort(403);
        return $next($request);
    }
}
