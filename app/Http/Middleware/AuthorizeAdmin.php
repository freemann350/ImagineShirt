<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!($request->user()->user_type == 'A')) {
            return $request->expectsJson()
            ? abort(403, 'You are not an administrator.')
            : abort(404)
            ->with('alert-msg', 'You are not an administrator.')
            ->with('alert-type', 'danger');
        }

        return $next($request);
    }
}
