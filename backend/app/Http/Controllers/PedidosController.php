<?php

namespace App\Http\Controllers;

use App\Http\Resources\EstabelecimentosResource;
use App\Http\Resources\PedidosResource;
use App\Models\EstabelecimentoPedidos;
use App\Models\Estabelecimentos;
use App\Models\Pedidos;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public function index()
    {
        $produtos = Pedidos::with('produtos')->get();
        return PedidosResource::collection($produtos);
    }

    public function show($title)
    {
        $estabelecimento = Estabelecimentos::where('estabelecimento_nome', $title)->first();
        if (!$estabelecimento) {
            return response()->json(['message' => 'Estabelecimento não encontrado'], 404);
        }

        $estabelecimento->load('pedidos');
        return new EstabelecimentosResource($estabelecimento);
    }

    public function store(Request $request)
    {

        $request->validate([
            'estabelecimento_id' => 'required|exists:estabelecimentos,id',
            'produtos.*.id' => 'required|exists:produtos,id',
            'produtos.*.quantidade' => 'required|integer|min:1',
        ]);

        $pedido = new Pedidos();
        $pedido->user_id = $request->estabelecimento_id;
        $pedido->save();

        foreach ($request->produtos as $produto) {

            EstabelecimentoPedidos::create([
                'pedido_id' => $pedido->id,
                'produto_id' => $produto['id'],
                'estabelecimento_id' => $request->estabelecimento_id,
                'valor_produto' => $produto['produto_valor'],
                'quantidade_produtos' => $produto['quantidade'],
            ]);
        }

        return response()->json(['message' => 'Pedido criado com sucesso', 'pedido' => $pedido], 201);
    }
}
