<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public function productos(){
        return $this->belongsTo(Producto::class);
    }
    public function comentarios(){
        return $this->morphMany(Comentario::class,'commentable');
    }
}
