<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Categoria;
use App\Models\Curso;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 5 categorías
        $categorias = Categoria::factory(5)->create();

        // 20 cursos asociados aleatoriamente a esas categorías
        Curso::factory(20)->create([
            'categoria_id' => fn () => $categorias->random()->id,
        ]);
    }
}

