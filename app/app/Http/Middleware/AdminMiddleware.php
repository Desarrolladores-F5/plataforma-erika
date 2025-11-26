<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si no está logueado o no es admin, mostramos 403
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'Acceso no autorizado');
        }

        return $next($request);
    }
}
