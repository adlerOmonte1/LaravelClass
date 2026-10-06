<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\MatriculaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('home'));

Auth::routes();   // login, register, logout y reset (Laravel UI)

Route::middleware('auth')->group(function () {
    // Controlador invocable: no se indica método
    Route::get('/home', DashboardController::class)->name('home');

    // Resource controllers: 7 rutas cada uno
    Route::resource('categorias', CategoriaController::class);

    Route::resource('cursos', CursoController::class)
        ->missing(fn () => response()->view('cursos.no-disponible', [], 404));

    Route::resource('estudiantes', EstudianteController::class);

    // Matrícula (N:M con pivote) desde el detalle del curso
    Route::post('/cursos/{curso}/matriculas', [MatriculaController::class, 'store'])
        ->name('matriculas.store');
    Route::put('/cursos/{curso}/notas', [MatriculaController::class, 'notas'])
        ->name('matriculas.notas');
    Route::delete('/cursos/{curso}/matriculas/{estudiante}', [MatriculaController::class, 'destroy'])
        ->name('matriculas.destroy');
});
