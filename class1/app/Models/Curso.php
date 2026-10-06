<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    //

    use HasFactory;
    public const NIVELES = ['basico','intermedio','avanzado'];
    protected $fillable = [
        'categoria_id','codigo','titulo',
        'descripccion','nivel','creditos',
        'cupos','fecha_inicio','publicado',
    ];
    protected $casts =[
        'publicado' =>'boolean',
        'fecha_inicio'=>'date',
    ];
    // N:M
    public function estudiantes(){
        return $this->belongsToMany(Estudiante::class, 'matriculas')
            ->withPivot('fecha_matricula','nota')
            ->withTimestamps();
    }

    public function scopePublicados($query){
        return $query->where('publicado',true);
    }
    public function cuposDisponibles():int{
        return $this->cupos - $this->estudiantes()->count();
    }



}
