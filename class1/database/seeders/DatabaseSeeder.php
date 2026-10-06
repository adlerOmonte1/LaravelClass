<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->call([
            CategoriaSeeder::class,     // padres (y sus cursos)
            EstudianteSeeder::class,    // estudiantes y perfiles
            MatriculaSeeder::class,     // al final, la pivote
        ]);
    }
}


//php artisan make:model Perfil -m
//php artisan make:migration create_matriculas_table

// Instalar LOGIN UI
//composer require laravel/ui
//php artisan ui bootstrap --auth
//php artisan migrate


//php artisan make:factory CategoriaFactory --model=Categoria
//php artisan make:factory CursoFactory --model=Curso
//php artisan make:factory EstudianteFactory --model=Estudiante
//php artisan make:factory PerfilFactory --model=Perfil
//php artisan make:seeder CategoriaSeeder
//php artisan make:seeder EstudianteSeeder
//php artisan make:seeder MatriculaSeeder

// PARA CORRERR
// php artisan migrate:fresh --seed
//php artisan tinker

//php artisan make:controller DashboardController --invokable
//php artisan make:controller CategoriaController --resource --model=Categoria
//php artisan make:controller CursoController --resource --model=Curso
//php artisan make:controller EstudianteController --resource --model=Estudiante
//php artisan make:controller MatriculaController
//php artisan make:request CursoRequest
//php artisan make:request EstudianteRequest
//php artisan make:rule DniValido
