<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticatedWithRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Ambil user yang sedang login
            $user = Auth::user();

            // Tentukan route redirect berdasarkan role user
            $redirectRoute = $user->role == 'admin' ? 'admin.attendance' : 'absen.user.index';

            // Redirect ke route yang sesuai
            return redirect()->route($redirectRoute);
        }
        
        return $next($request);
    }
}
