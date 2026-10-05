<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descripcion', 'nivel', 'categoria_id'];

    // Un curso pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}