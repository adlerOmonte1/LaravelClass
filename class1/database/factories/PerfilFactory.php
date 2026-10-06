<?php

namespace Database\Factories;

use App\Models\Perfil;
use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Perfil>
 */
class PerfilFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'estudiante_id' => Estudiante::factory(),
            'celular' => '9' . fake()->numerify('########'),
            'direccion'=> fake()->streetAddress(),
            'biografia'=> fake()->sentence(12),
        ];
    }
}
