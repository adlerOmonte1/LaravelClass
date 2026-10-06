<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// MatriculaSeeder.php  — N:M: cada estudiante en 3 cursos publicados al azar
use App\Models\Curso;
use App\Models\Estudiante;

class MatriculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cursos = Curso::publicados()->get();

        Estudiante::all()->each(function (Estudiante $estudiante) use ($cursos) {
            $elegidos = $cursos->random(min(3, $cursos->count()));

            foreach ($elegidos as $curso) {
                $estudiante->cursos()->attach($curso->id, [
                    'fecha_matricula' => fake()->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
                    'nota'            => fake()->optional(0.7)->randomFloat(2, 5, 20),   // 30 % sin nota
                ]);
            }
        });
    }
}
