<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    public function index(){
        $profesores = Profesor::all();
        return view('profesores.index', compact('profesores'));
    }
    public function create(){
        return view('profesores.create');
    }
    public function store(Request $request){
        $request->validate([
            'dni' => 'required|unique|max:8',
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
        ]);
        Profesor::create($request->all());
        return redirect('/profesores');
    }
    public function formAsistencia($id){
        $profesor = Profesor::findOrFail($id);
        return view('profesores.marcar-asistencia', compact('profesor'));
    }
    public function marcarAsistencia($id){
        $profesor = Profesor::findOrFail($id);
        $profesor->asistencias()->create([
            'hora_marcacion' => now(),
        ]);
        return redirect('/profesores/{$id}/asistencia')->with('mensaje', 'Asistencia registrada correctamente');
    }

}
