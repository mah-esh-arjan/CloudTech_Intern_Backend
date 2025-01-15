<?php

namespace App\Http\Middleware;

use Closure;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ProtectedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $email = Auth::user()->email;
            $user = DB::table('users')->where('email', $email)->first();
            if ($user->Registered) {
                return redirect('/dashboard');
            }
            else{
                return redirect('/error');
            }
            }
        }
    }

