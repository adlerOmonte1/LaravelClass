<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profesores', [ProfesorController::class, 'index']);
Route::get('/profesores/crear', [ProfesorController::class, 'create']);
Route::post('/profesores', [ProfesorController::class, 'store']);
Route::get('/profesores/{id}/editar', [ProfesorController::class, 'edit']);
Route::post('/profesores/{id}', [ProfesorController::class, 'update']);