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
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // For SPA
                // See: https://laravelvuespa.com/authentication/laravel-authentication#redirecting-if-authenticated
                if ($request->expectsJson()) {
                    // 認証済みユーザによるユーザ登録, 再ログインを許可
                    return $next($request);

                    // return response()->json(['error' => 'Already authenticated.'], 200);
                }

                // For Other views
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
