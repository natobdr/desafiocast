<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdutosResource extends JsonResource
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
            'produto_nome' => $this->produto_nome,
            'produto_valor' => $this->produto_valor,
            'categorias' => CategoriasResource::collection($this->whenLoaded('categorias')),
            'estabelecimentos' => EstabelecimentosResource::collection($this->whenLoaded('estabelecimento')),
        ];
    }
}
