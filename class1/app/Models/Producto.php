<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Producto extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['nombre', 'precio', 'stock', 'publicado', 'categoria_id'];

    public function categoria(){
        return $this->belongsTo(Categoria::class);     
    }
    public function etiquetas(){
        return $this->belongsToMany(Etiqueta::class)->withTimestamps();
    }
    public function comentarios(){
        return $this->morphMany(Comentario::class, 'commentable');
    }

    public function totalProductosCategorias($query)
    {
        return $query = select ('categoria_id', DB::raw('COUNT(*) as total'))
            ->groupBy('categoria_id');
    }
    public function productosCategoriasMas5Publicados($query){
        return $query = select ('categoria_id', DB::raw('COUNT(*) as total'))
            ->groupBy('categoria_id')
            ->having('total', '>', 5);
    }

}
