<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','titulo','descripcion', 'nivel','publicado'];
    protected $casts = ['publicado' =>'boolean'];

    //N:1
    public function categoria(){
        return $this->belongsTo(Categoria::class, 'category_id');
    }
}
