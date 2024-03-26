<?php

namespace App\Http\Controllers;

use App\Http\Resources\EstabelecimentosResource;
use App\Http\Resources\ProdutosResource;
use App\Models\Categorias;
use App\Models\Enderecos;
use App\Models\EstabelecimentoCategorias;
use App\Models\Estabelecimentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstabelecimentosController extends Controller
{
    public function index()
    {
        $estabelecimentos = Estabelecimentos::with('produtos', 'categorias')->get();
        return EstabelecimentosResource::collection($estabelecimentos);
    }

    public function show(Estabelecimentos $estabelecimento)
    {
        $estabelecimento->load('categorias','produtos');
        return new EstabelecimentosResource($estabelecimento);
    }

    public function produtos($id)
    {
        $estabelecimento = Estabelecimentos::findOrFail($id);
        $produtos = $estabelecimento->produtos()->get();

        return ProdutosResource::collection($produtos);
    }

    public function store(Request $request)
    {

        DB::beginTransaction();

        try {

            // Criando o estabelecimento relacionado ao endereço
            $estabelecimento = Estabelecimentos::create([
                'estabelecimento_nome' => $request->nome,
                'estabelecimento_descricao' => $request->descricao,
            ]);


            // Criando o endereço
            $endereco = Enderecos::create([
                'endereco_cep' => $request->cep,
                'endereco_logradouro' => $request->logradouro,
                'endereco_bairro' => $request->bairro,
                'endereco_cidade' => $request->cidade,
                'eendereco_estado' => $request->estado,
                'estabelecimento_id' => $estabelecimento->id,
            ]);

            $categoria = $request->categoria_id;

            // Criando a categoria
            $endereco = EstabelecimentoCategorias::create([
                'estabelecimento_id' => $estabelecimento->id,
                'categoria_id' => $categoria,
            ]);



            // Confirma a transação
            DB::commit();

            // Retorna uma resposta de sucesso com os dados do estabelecimento criado
            return response()->json(['message' => 'Estabelecimento criado com sucesso', 'data' => new EstabelecimentosResource($estabelecimento)], 201);

        } catch (\Exception $e) {
            // Em caso de falha, reverte a transação
            DB::rollBack();

            // Retorna uma resposta de erro
            return response()->json(['message' => 'Erro ao criar estabelecimento', 'error' => $e->getMessage()], 500);
        }
    }
}
