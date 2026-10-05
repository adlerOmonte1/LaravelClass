<?php

namespace Database\Factories;

use App\Models\Participante;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Participante>
 */
class ParticipanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=>fake()->words(2),
            'creditos' =>fake()->numberBetween(1, 5),
            'horas' =>fake()->numberBetween(1, 10),
            'codigo'=>fake()->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'prerequisitos'=>fake()->word(),
            'ciclo'=>fake()

        ];
    }
}
