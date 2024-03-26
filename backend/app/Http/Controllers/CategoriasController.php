<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriasResource;
use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = Categorias::all();
        return CategoriasResource::collection($categorias);
    }

    public function show(Categorias $categoria){

        return new CategoriasResource($categoria);

    }

    public function create($request)
    {
        $categoria = new Categorias();
        $categoria->categoria_nome =$request;
        $categoria->save();
        return ;
    }
}
