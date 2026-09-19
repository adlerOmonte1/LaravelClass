<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = ['id_profesor', 'hora_marcacion'];
    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }
    public function horarioDetalles()
    {
        return $this->hasMany(HorarioDetalle::class);
    }
}

