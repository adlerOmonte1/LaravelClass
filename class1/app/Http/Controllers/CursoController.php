<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $categorias = Categoria::orderBy('nombre')->get();
        $query = Curso::with('categoria');
        if($request ->filled('categoria')){
            $query->where('category_id', $request->categoria);
        }
        $cursos = $query->get();
        return view('cursos.index',compact('cursos','categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();
        return view('cursos.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // valida, guarda y redirique a show con mensaje
        $datos = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' =>'required|string',
            'nivel'=>'required|in:Basico,Intermedio,Avanzado',
            'category_id'=>'required|exist:categorias,id'
        ]);
        $datos['publicado'] =$request->boolean('publicado');
        $curso = Curso::create($datos);
        return redirect()->route('cursos.show',$curso)->with('Success','Curso registrado');

    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        //
        if(!$curso->publicado){
            return view('curso.no-disponible');
        }
        $sugerencias = Curso::where('category_id',$curso->category_id)
            ->where('publicado',true)
            ->where('id','!=',$curso->id)
            ->latest()
            ->take(3)
            ->get();
        return view('cursos.show', compact('curso','sugerencias'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
