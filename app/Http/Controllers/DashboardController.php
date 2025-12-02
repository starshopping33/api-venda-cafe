<?php

namespace App\Http\Controllers;

use App\Models\FilaCompra;
use App\Models\HistoricoDeCompra;
use App\Models\HistoricoDeCompras;
use App\Models\User;


class DashboardController extends Controller
{
      public function index()
    {
     
        $proximo = FilaCompra::with('user')
            ->orderBy('posicao_fila', 'asc')
            ->first();

      
        $ultimaCompra = HistoricoDeCompras::with('user')
            ->orderBy('created_at', 'desc')
            ->first();

     
        $ultimas5 = HistoricoDeCompras::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        
        $comprasPorUsuario = User::withCount('historicoCompras')
            ->orderBy('historico_compras_count', 'desc')
            ->get();

        return response()->json([
            "proximo_na_fila" => $proximo ? $proximo->user->name : "Fila vazia",
            "ultima_compra" => $ultimaCompra,
            "ultimas_compras" => $ultimas5,
            "compras_por_usuario" => $comprasPorUsuario
        ]);
    }
}
