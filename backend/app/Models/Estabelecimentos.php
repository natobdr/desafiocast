<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estabelecimentos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'estabelecimento_nome',
        'estabelecimento_descricao',
    ];

    public function categorias()
    {
        return $this->belongsToMany(Categorias::class, 'estabelecimento_categorias', 'estabelecimento_id', 'categoria_id');
    }

    public function produtos()
    {
        return $this->hasMany(Produtos::class, 'estabelecimento_id', 'id');
    }

    public function enderecos()
    {
        return $this->hasMany(Enderecos::class, 'estabelecimento_id', 'id');
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedidos::class, 'estabelecimento_pedidos', 'pedido_id', 'estabelecimento_id');
    }
}
