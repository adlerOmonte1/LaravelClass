<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Curso;
use App\Models\Estudiante;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('dashboard', [
            'totalCategorias'  => Categoria::count(),
            'totalCursos'      => Curso::count(),
            'totalPublicados'  => Curso::publicados()->count(),
            'totalEstudiantes' => Estudiante::count(),
            'totalMatriculas'  => DB::table('matriculas')->count(),   // Query Builder sobre la pivote
            'ultimosCursos'    => Curso::with('categoria')->latest()->take(5)->get(),
            'categorias'       => Categoria::withCount('cursos')->orderByDesc('cursos_count')->get(),
        ]);
    }
}
