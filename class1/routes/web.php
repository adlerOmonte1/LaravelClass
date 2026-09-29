<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipanteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/participantes/create', [ParticipanteController::class,'create'])
    ->name('participantes.create');
Route::post('/participantes',[ParticipanteController::class,'store'])
    ->name('participantes.store');