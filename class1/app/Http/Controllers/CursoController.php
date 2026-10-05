<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
class CursoController extends Controller
{
    //
    public function index()
    {
        $cursos = Curso::with('categoria')->orderBy('titulo')->get();

        return view('cursos.index', compact('cursos'));
    }
}
