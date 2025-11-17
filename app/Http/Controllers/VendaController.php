<?php 

namespace App\Http\Controllers;

use App\Http\Requests\RequestVenda;
use App\Models\FilaCompra;
use Illuminate\Http\Request;

class VendasController extends Controller
{
   
    public function entrarFila(RequestVenda $request)
    {
        $userId = $request->user_id;


      
        if (FilaCompra::where('user_id', $userId)->exists()) {
            return response()->json([
                'erro' => 'Usuário já está na fila'
            ], 400);
        }

       
        $ultimaPosicao = FilaCompra::max('posicao_fila') ?? 0;

      
        $fila = FilaCompra::create([
            'user_id' => $userId,
            'posicao_fila' => $ultimaPosicao + 1
        ]);

        return response()->json($fila);
    }


    public function FazerCompra(Request $request)
    {
        $userId = $request->user_id;

      
        $fila = FilaCompra::where('user_id', $userId)->first();

        if (!$fila) {
            return response()->json(['erro' => 'Usuário não está na fila'], 404);
        }

       
        $ultimaPosicao = FilaCompra::max('posicao_fila');

       
        $fila->update([
            'posicao_fila' => $ultimaPosicao + 1
        ]);

        return response()->json([
            'mensagem' => 'Compra registrada e usuário movido para o final da fila',
            'nova_posicao' => $fila->posicao_fila
        ]);
    }
}
