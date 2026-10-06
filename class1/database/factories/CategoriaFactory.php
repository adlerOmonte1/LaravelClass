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
            'nombre'=>fake()->unique()->randomElement([
                'Programación', 'Base de Datos', 'Redes', 'Inteligencia Artificial',
                'Ciberseguridad', 'Diseño Web', 'Cloud Computing', 'Gestión de Proyectos',
            ]),
            'descripcion'=>fake()->sentence(10),
        ];
    }
}
