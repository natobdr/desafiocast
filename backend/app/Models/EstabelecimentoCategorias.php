<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstabelecimentoCategorias extends Model
{
    use HasFactory;

    protected $fillable = ['estabelecimento_id', 'categoria_id'];
}
