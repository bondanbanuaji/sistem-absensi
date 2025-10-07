<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                // Redirect sesuai role
                return match($user->role) {
                    'admin' => redirect()->route('dashboard.admin'),
                    'teacher' => redirect()->route('dashboard.teacher'),
                    'student' => redirect()->route('dashboard.student'),
                    default => redirect('/login'),
                };
            }
        }

        return $next($request);
    }
}
