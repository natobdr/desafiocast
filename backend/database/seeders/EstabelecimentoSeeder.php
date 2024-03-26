<?php

namespace Database\Seeders;

use App\Models\Categorias;
use App\Models\Estabelecimentos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstabelecimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = Categorias::all();
        $categorias->each(function ($categorias){
            $categorias->categorias()->createOne(Estabelecimentos::factory(1)->make()->toArray());
        });
    }
}
