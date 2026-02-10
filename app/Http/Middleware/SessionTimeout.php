<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SessionTimeout
{
    public function handle($request, Closure $next)
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Obtener la marca de tiempo de la última actividad en la sesión
            $lastActivity = Session::get('lastActivity');
            $currentTime = now();

            // Verificar si la sesión ha caducado
            if ($lastActivity && $currentTime->diffInSeconds($lastActivity) > config('session.lifetime')) {
                // La sesión ha caducado, redirigir al inicio de sesión
                return redirect('/login');
            }

            // Actualizar la marca de tiempo de la última actividad en la sesión
            Session::put('lastActivity', $currentTime);
        }

        return $next($request);
    }
}
