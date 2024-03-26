<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EstabelecimentosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'estabelecimento_nome' => $this->estabelecimento_nome,
            'estabelecimento_descricao' => $this->estabelecimento_descricao,
            'categorias' => CategoriasResource::collection($this->whenLoaded('categorias')),
            'enderecos' => EnderecoResource::collection($this->whenLoaded('enderecos')),
            'produtos' => ProdutosResource::collection($this->whenLoaded('produtos')),
            /*'endereco' => EnderecoResource::collection($this->whenLoaded('endereco')),*/
        ];
    }
}
