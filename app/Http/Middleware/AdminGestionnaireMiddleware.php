<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminGestionnaireMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur a le rôle 'admin' ou 'gestionnaire'
        if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'gestionnaire')) {
            return $next($request);
        }

        // Si l'utilisateur n'a pas les bons rôles, redirige-le
        return redirect()->route('user.dashboard');
    }
}
