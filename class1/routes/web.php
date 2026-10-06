<?php

use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', fn()=>redirect()->route('cursos.index'));

Route::resource('cursos', CursoController::class)
    ->only(['index','create','store','show'])
    ->missing(fn () => response()->view('cursos.no-disponible', [], 404));

