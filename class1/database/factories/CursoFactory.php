<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Curso>
 */
class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'categoria_id'=>Categoria::factory(),
            'codigo'=>fake()->unique()->bothify('CUR-###'),
            'titulo'=>ucfirst(fake()->words(3,true)),
            'descripcion'=>fake()->paragraph(),
            'nivel' =>fake()->randomElement(Curso::NIVELES),
            'creditos'=>fake()->numberBetween(2,5),
            'cupos'=>fake()->numberBetween(15,40),
            'fecha_inicio'=>fake()->dateTimeBetween('-1 month', '+2 months')->format('Y-m-d'),
            'publicado'    => fake()->boolean(75),
        ];
    }
    public function publicado():static
    {
        return $this->state(fn(array $attributes)=>['publicado'=>true]);
    }
}
