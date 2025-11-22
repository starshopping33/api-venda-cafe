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
        $produto = $request->produto; 

       
        if (!in_array($produto, ['cafe', 'filtro'])) {
            return response()->json([
                'erro' => 'Produto inválido. Use cafe ou filtro.'
            ], 400);
        }

       
        if (FilaCompra::where('user_id', $userId)->exists()) {
            return response()->json([
                'erro' => 'Usuário já está na fila'
            ], 400);
        }

       
        $ultimaPosicao = FilaCompra::max('posicao_fila') ?? 0;

        $fila = FilaCompra::with('user')
    ->orderBy('posicao_fila', 'asc')
    ->get()
    ->map(function ($item) {
        return [
            'id'          => $item->id,
            'user_id'     => $item->user_id,
            'nome'        => $item->user->name,
            'produto'     => $item->produto,
            'posicao_fila'=> $item->posicao_fila,
        ];
    });

        return response()->json([
            'mensagem' => 'Usuário entrou na fila com sucesso',
            'dados' => $fila
        ]);
    }

    public function FazerCompra(Request $request)
    {
        $userId = $request->user_id;

        
        $fila = FilaCompra::where('user_id', $userId)->first();

        if (!$fila) {
            return response()->json(['erro' => 'Usuário não está na fila'], 404);
        }

        $produto = $fila->produto;

        $fila->delete();

        return response()->json([
            'mensagem' => "Compra de {$produto} realizada com sucesso e usuário removido da fila"
        ]);
    }

  public function listarFila()
{
    $fila = FilaCompra::with('user') 
        ->orderBy('posicao_fila', 'asc')
        ->get()
        ->map(function ($item) {
            return [
                'id'            => $item->id,
                'user_id'       => $item->user_id,
                'nome'          => $item->user->name, 
                'produto'       => $item->produto,
                'posicao_fila'  => $item->posicao_fila,
            ];
        });

    return response()->json($fila);
}
}
