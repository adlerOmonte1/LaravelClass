<?php

namespace Database\Factories;

use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Estudiante>
 */
class EstudianteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
     {
        return [
            'codigo'=> fake()->unique()->numerify('2026######'),
            'dni'=> fake()->unique()->numerify('########'),
            'nombres'=> fake()->firstName(),
            'apellidos'=> fake()->lastName() . ' ' . fake()->lastName(),
            'email'=> fake()->unique()->safeEmail(),
            'fecha_nacimiento'=> fake()->dateTimeBetween('-35 years', '-17 years')->format('Y-m-d'),
            'modalidad'=> fake()->randomElement(['presencial', 'virtual']),
        ];
    }
}
