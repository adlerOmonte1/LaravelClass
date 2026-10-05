<?php

namespace Database\Factories;

use App\Models\Curso;
use App\Models\Categoria;

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
        $prefijo = fake()->randomElement([
            'Introducción a', 'Fundamentos de', 'Taller de', 'Curso avanzado de', 'Domina',
        ]);
        $tema = fake()->randomElement([
            'Laravel', 'PHP', 'JavaScript', 'MySQL', 'Python', 'Docker',
            'Vue.js', 'React', 'Machine Learning', 'Linux', 'Git y GitHub',
        ]);

        return [
            'titulo'       => "$prefijo $tema",
            'descripcion'  => fake()->paragraph(3),
            'nivel'        => fake()->randomElement(['Básico', 'Intermedio', 'Avanzado']),
            'categoria_id' => Categoria::factory(),
        ];
    }


}
