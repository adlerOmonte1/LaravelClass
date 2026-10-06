<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// CategoriaSeeder.php  — 1:N: 5 categorías con 4 cursos cada una
use App\Models\Categoria;
use App\Models\Curso;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    Categoria::factory()
        ->count(5)
        ->has(Curso::factory()->count(4), 'cursos')
        ->create();
    }
}
