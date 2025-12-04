<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se está autenticado
        if (!$request->user()) {
            return response()->json([
                'message' => 'Não autenticado.'
            ], 401);
        }

        // Verifica se é admin
        if ($request->user()->is_admin != 1) {
            return response()->json([
                'message' => 'Acesso negado. Apenas administradores podem acessar.'
            ], 403);
        }

        return $next($request);
    }

    
}
