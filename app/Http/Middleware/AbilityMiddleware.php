<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AbilityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$ability): Response
    
        {
            // Check if user is authenticated and has the ability
            if (!$request->user() || !$request->user()->tokenCan($ability)) {
                return response()->json(['error' => 'Access denied'], 403);
            }
    
            return $next($request);
        }
    
}
