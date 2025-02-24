<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAbilities
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$abilities): Response
    {
        $user = $request->user();
        if (!$user || !$user->currentAccessToken()) {
            abort(403, 'Unauthorized');
        }

        // Check if the token has at least one required ability
        foreach ($abilities as $ability) {
            if ($user->tokenCan($ability)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized');
    }
}
