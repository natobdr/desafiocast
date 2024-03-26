<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstabelecimentoPedidos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'pedido_id',
        'produto_id',
        'estabelecimento_id',
        'valor_produto',
        'quantidade_produtos',
    ];


}
