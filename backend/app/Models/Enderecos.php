<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enderecos extends Model
{
    use HasFactory;

    protected $table = 'enderecos';

    protected $fillable = [
        'id',
        'endereco_cep',
        'endereco_logradouro',
        'endereco_bairro',
        'endereco_cidade',
        'endereco_estado',
        'estabelecimento_id',
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public function estabelecimento()
    {
        return $this->belongsTo(Estabelecimentos::class, 'id', 'estabelecimento_id');
    }
}
