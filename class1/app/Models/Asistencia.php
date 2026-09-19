<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = ['id_profesor', 'hora_marcacion'];
    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }
}
