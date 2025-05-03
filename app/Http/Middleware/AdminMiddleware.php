<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Check if user has admin privileges
        if (!in_array(auth()->user()->role, ['admin', 'manager'])) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Forbidden'], 403);
            }
            
            return redirect()
                ->route('home')
                ->with('error', 'You do not have permission to access this area.');
        }

        return $next($request);
    }
}