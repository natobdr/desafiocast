<?php

namespace Database\Seeders;

use App\Models\Categorias;
use App\Models\Estabelecimentos;
use App\Models\Produtos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estabelecimento = Estabelecimentos::all();

        $estabelecimento->each(function ($estabelecimento){
            $estabelecimento->produtos()->createMany(Produtos::factory(10)->make(['categoria_id' => $estabelecimento->categoria_id])->toArray());
        });
    }
}
