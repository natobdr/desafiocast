<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'categoria_nome',
    ];

    public function estabelecimento()
    {
        return $this->belongsToMany(Estabelecimentos::class, 'estabelecimento_categorias', 'categoria_id', 'estabelecimento_id');
    }

    public function produtos()
    {
        return $this->belongsToMany(Produtos::class, 'produtos_categoria', 'categoria_id', 'produtos_id');
    }
}
