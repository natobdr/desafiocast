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

    public function show(Produtos $produtos)
    {
        dd($produtos);
        $produtos->load('categorias');
        return new ProdutosResource($produtos);
    }

    public function edit(Produtos $produtos)
    {

    }
}
