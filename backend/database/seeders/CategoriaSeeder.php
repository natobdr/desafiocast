<?php

namespace Database\Seeders;

use App\Models\Estabelecimentos;
use App\Models\Produtos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estabelecimentos::factory(10);
    }
}
