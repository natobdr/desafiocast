<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'numero_pedido',
    ];

    public function produtos()
    {
        return $this->belongsToMany(Produtos::class, 'estabelecimento_pedidos', 'pedido_id', 'produto_id');
    }

    public function estabelecimento()
    {
        return $this->belongsToMany(Estabelecimentos::class, 'estabelecimento_pedidos', 'estabelecimento_id', 'pedido_id');
    }

}
