<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and if their role is not 'admin'
        if (Auth::check() && Auth::user()->role != 'super admin') {
            // Return a 403 response if the user is not an admin
            return response('Unauthorized action.', 403);
        }
 
        // dd(Auth::user());Allow the request to proceed if the user is an admin
        return $next($request);
    }
}
