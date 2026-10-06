<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo','dni','nombres','apellidos','email','fecha_nacimiento',
        'modalidad',
    ];
    protected $casts = [
        'fecha_nacimiento' =>'date',
    ];

    // 1:1 estudiante tiene un perfil
    public function perfil(){
        return $this->hasOne(Perfil::class);
    }
    //N:M un estudiante esta en muchos cursos
    public function cursos(){
        return $this->belongsToMany(Curso::class, 'matriculas')
            ->withPivot('fecha_matricula','nota')
            ->withTimestamps();
    }



}
