<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Curso;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $niveles = ['Basico', 'Intermedio', 'Avanzado'];
        foreach(['Programacion', 'Base de Datos', 'Redes'] as $nombre ){
            $categoria = Categoria::firstOrCreate(['nombre'=>$nombre]);
            for($i=1 ; $i <=4 ; $i++){
                Curso::create([
                    'category_id'=>$categoria->id,
                    'titulo'=>"$nombre $i",
                    'descripcion'=>"Curso de prueba $i de $nombre",
                    'nivel' =>$niveles[$i %3],
                    'publicado'=>$i !==4,
                ]);
            }
        }
    }
}
