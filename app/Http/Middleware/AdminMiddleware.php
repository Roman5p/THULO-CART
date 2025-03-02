<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has the 'admin' role
        if (Auth()->check() && Auth::user()->role === 'admin') {
            // Allow the request to proceed
            return $next($request);
        }
        // Redirect to the index route with an error message if the user is not an admin
        return redirect()->route('index')->with('error', 'You do not have permission to access this page.');
    }

}
