<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
            ? abort(404, 'You are not an employee/administrator.')
            : redirect()->route('catalog')
            ->with('alert-msg', 'You are not an employee/administrator.')
            ->with('alert-type', 'danger');
        }

        return $next($request);
    }
}
