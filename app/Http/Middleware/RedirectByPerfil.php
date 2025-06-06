<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectByPerfil
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $perfil = Auth::user()->perfil;

            switch ($perfil) {
                case 'administrador':
                    return redirect()->route('admin.dashboard');
                case 'vigilante':
                    return redirect()->route('vigilante.dashboard');
                case 'recepcionista':
                    return redirect()->route('recepcionista.dashboard');
                default:
                    return redirect()->route('home'); // ou página padrão
            }
        }

        return $next($request);
    }
}
