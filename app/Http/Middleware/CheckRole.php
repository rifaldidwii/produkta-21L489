<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        abort_if($role == 'admin' && !auth()->user()->isAdmin(), 403);

        abort_if($role == 'teacher' && !auth()->user()->isTeacher(), 403);

        abort_if($role == 'student' && !auth()->user()->isStudent(), 403);

        return $next($request);
    }
}
