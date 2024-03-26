<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProdutosResource;
use App\Models\Produtos;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produtos::with('categorias', 'estabelecimentos')->get();
        return ProdutosResource::collection($produtos);
    }

    public function show($title)
    {
        $produto = Produtos::where('produto_nome', $title)->first();
        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }
        return new ProdutosResource($produto);
    }

    public function store(Request $request)
    {
        $request->validate([
            'estabelecimento_id' => 'required|exists:estabelecimentos,id',
            'produto_nome' => 'required',
            'produto_valor' => 'required|numeric',
        ]);

        $produto = new Produtos();
        $produto->estabelecimento_id = $request->estabelecimento_id;
        $produto->produto_nome = $request->produto_nome;
        $produto->produto_valor = $request->produto_valor;
        $produto->save();

        return response()->json(['message' => 'Produto criado com sucesso', 'produto' => $produto], 201);
    }
}
