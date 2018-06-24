<?php

namespace App\Http\Middleware;

use Closure;

// https://laravel.com/docs/5.6/middleware#middleware-parameters
class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (! $request->user()->hasRole($role)) {
            return response()->json(['error' => 'Unauthorized'], 401);;
        }

        return $next($request);
    }

}