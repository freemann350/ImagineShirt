<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!($request->user()->user_type == 'A' || $request->user()->user_type == 'E')) {
            return $request->expectsJson()
            ? abort(403, 'You are not an employee/administrator.')
            : abort(404)
            ->with('alert-msg', 'You are not an employee/administrator.')
            ->with('alert-type', 'danger');
        }

        return $next($request);
    }
}
