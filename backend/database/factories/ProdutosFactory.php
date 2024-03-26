<?php

namespace Database\Factories;

use App\Models\Produtos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProdutosFactory extends Factory
{
    protected $model = Produtos::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'produto_nome' => fake()->sentence(1),
            'produto_valor' => $this->faker->randomFloat('2',0,2),
            'categoria_id' => '',
            ];
    }
}
