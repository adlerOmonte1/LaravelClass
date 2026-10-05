<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Categoria>
 */
class CategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->unique()->randomElement([
                'Desarrollo Web', 'Bases de Datos', 'Inteligencia Artificial',
                'Redes y Seguridad', 'Desarrollo Móvil', 'Cloud Computing',
                'Diseño UX/UI', 'DevOps',
            ]),
            'descripcion' => fake()->optional(0.8)->sentence(12),
        ];
    }
}

