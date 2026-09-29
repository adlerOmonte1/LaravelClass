<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    protected $fillable = [
        'nombres',
        'apellidos',
        'dni',
        'correo',
        'celular',
        'fecha_nacimiento',
        'modalidad',
        'es_estudiante',
        'codigo_estudiante',
        'ciclo'
    ];
    protected $casts = [
        'fecha_nacimiento' => 'date',
        'es_estudiante' => 'boolean',
    ];
}
