<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioDetalle extends Model
{
    protected $fillable = ['id_horario', 'dia', 'hora_entrada', 'hora_salida'];
    public function horario()
    {
        return $this->belongsTo(Horario::class);
    }
}
