<?php

namespace Database\Factories;

use App\Models\Estabelecimentos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EstabelecimentoFactory extends Factory
{
    protected $model = Estabelecimentos::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'estabelecimento_nome' => fake()->name(),
            'Estabelecimento_descricao' => $this->faker->sentences('2',0,2),
        ];
    }
}
