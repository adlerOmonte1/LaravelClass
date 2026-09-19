<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $fillable = ['dni', 'nombres', 'apellidos'];
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}
