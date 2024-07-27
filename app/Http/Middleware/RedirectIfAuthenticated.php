<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                // Redirect based on role
                if ($user->hasRole('SuperAdmin')) {
                    return redirect(RouteServiceProvider::DASHBOARD);
                } elseif ($user->hasRole('Student')) {
                    return redirect(RouteServiceProvider::STUDENTDASHBOARD);
                } elseif ($user->hasRole('Account')) {
                    return redirect(RouteServiceProvider::ACCOUNTDASHBOARD);
                }
            }
        }

        return $next($request);
    }
}