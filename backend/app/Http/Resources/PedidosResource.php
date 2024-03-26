<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PedidosResource extends JsonResource
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
            'numero_pedido' => $this->numero_pedido,
            'user_id' => $this->user_id,
            'valor_produto' => $this->valor_produto,
            'produtos' => ProdutosResource::collection($this->whenLoaded('produtos')),
        ];
    }
}
