<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use Illuminate\Support\Facades\DB;

class CursoController extends Controller
{
    //
    public function index()
    {
        $cursos = DB::table('cursos')->get();
        return view('cursos.mostrar')->with('cursos', $cursos);
    }

    public function create(){
        return view('curso.registrar');
    }
    public function store(Request $request){
        $nombre = $request->input('nombre');
        $creditos =$request->input('creditos');
        $horas = $request->input('horas');
        $codigo = $request->input('codigo');
        $prerequisito = $request->input('prerequisito');
        $ciclo = $request->input('ciclo');

        DB::insert ("INSERT INTO cursos(nombre,creditos,horas,codigo,prerequisito,ciclo) VALUES (?,?,?,?,?,?)" , 
        [$nombre, $creditos, $horas, $codigo, $prerequisito, $ciclo]);

        return "Curso Registrado";
    }
    public function edit(string $curso)
    {
        $curso = Curso::find($id);
        return veiw('cursos.modificar')
            ->with('curso',$curso)
            ->with('id',$id);
    }
    public function update(Request $request){
        $request->validate([
            'nombre' => ['required', 'string','max:80'],
            'creditos' => 'required',
            'horas' => 'required',
            'codigo' => 'required',
            'prerequisito' => 'required',
            'ciclo' => 'required'
        ]);
        $nombre = $request->input('nombre');
        $creditos =$request->input('creditos');
        $horas = $request->input('horas');
        $codigo = $request->input('codigo');
        $prerequisito = $request->input('prerequisito');
        $ciclo = $request->input('ciclo');
        DB::insert ("UPDATE cursos SET nombre = ?, creditos = ?, horas = ?, codigo = ?, prerequisito = ?, ciclo = ? WHERE id = ?" , 
        [$nombre, $creditos, $horas, $codigo, $prerequisito, $ciclo, $request->input('id')]);

    }

}
