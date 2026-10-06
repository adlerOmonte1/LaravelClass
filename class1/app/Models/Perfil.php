<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;
    protected $table = 'perfil';
    protected $fillable = ['estudiante_id','celular','direccion','biografia'];

    // 1:1
    public function estudiante(){
        return $this->belongsTo(Estudiante::class);
    }


}
