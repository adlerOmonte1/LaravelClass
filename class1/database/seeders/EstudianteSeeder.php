<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// EstudianteSeeder.php  — 1:1: 30 estudiantes, cada uno con su perfil
use App\Models\Estudiante;
use App\Models\Perfil;

class EstudianteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    Estudiante::factory()
        ->count(30)
        ->has(Perfil::factory(), 'perfil')     // nombre de la relación obligatorio
        ->create();
    }
}
