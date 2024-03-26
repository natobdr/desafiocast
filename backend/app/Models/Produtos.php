<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'estabelecimento_id',
        'produto_nome',
        'produto_valor',
    ];

    public function categorias()
    {
        return $this->belongsToMany(Categorias::class, 'produtos_categoria', 'produtos_id', 'categoria_id');
    }

    public function estabelecimentos()
    {
        return $this->belongsTo(Estabelecimentos::class, 'estabelecimento_id', 'id');
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedidos::class, 'user_pedidos', 'pedido_id', 'produto_id');
    }
}
