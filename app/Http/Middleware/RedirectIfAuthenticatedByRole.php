<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedByRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            switch ($user->perfil) {
                case 'administrador':
                    return redirect('/admin/dashboard');
                case 'vigilante':
                    return redirect('/vigilante/dashboard');
                case 'motorista':
                    return redirect('/motorista/dashboard');
                default:
                    return redirect('/home');
            }
        }

        return $next($request);
    }
}
