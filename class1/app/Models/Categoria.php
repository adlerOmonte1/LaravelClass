<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre'];
    //relacion 1:N
    public function cursos(){
        return $this->hasMany(Curso::class, 'category_id');
    }
}
