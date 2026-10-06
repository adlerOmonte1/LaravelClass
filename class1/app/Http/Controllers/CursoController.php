<?php

namespace App\Http\Controllers;

use App\Http\Requests\CursoRequest;
use App\Models\Categoria;
use App\Models\Curso;
use App\Models\Estudiante;          // se usa en show (Fase 9)
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index(Request $request)
    {
        $categorias = Categoria::orderBy('nombre')->get();

        $cursos = Curso::with('categoria')
            ->withCount('estudiantes')
            ->when($request->filled('buscar'), function ($q) use ($request) {
                $q->where(function ($sub) use ($request) {        // (titulo LIKE ? OR codigo LIKE ?)
                    $sub->where('titulo', 'like', '%' . $request->buscar . '%')
                        ->orWhere('codigo', 'like', '%' . $request->buscar . '%');
                });
            })
            ->when($request->filled('categoria'), fn ($q) => $q->where('categoria_id', $request->categoria))
            ->when($request->filled('nivel'), fn ($q) => $q->where('nivel', $request->nivel))
            ->when($request->boolean('solo_publicados'), fn ($q) => $q->publicados())
            ->latest()
            ->paginate(8)
            ->withQueryString();                                  // conserva filtros al paginar

        return view('cursos.index', compact('cursos', 'categorias'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('cursos.create', ['curso' => new Curso, 'categorias' => $categorias]);
    }

    public function store(CursoRequest $request)
    {
        $curso = Curso::create($request->validated());

        return redirect()->route('cursos.show', $curso)->with('success', 'Curso registrado correctamente.');
    }

    // public function show(Curso $curso)  →  Fase 9

    public function edit(Curso $curso)
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return view('cursos.edit', compact('curso', 'categorias'));
    }

    public function update(CursoRequest $request, Curso $curso)
    {
        $matriculados = $curso->estudiantes()->count();

        if ($request->cupos < $matriculados) {                 // regla de negocio
            return back()->withInput()
                ->withErrors(['cupos' => "Hay {$matriculados} matriculados; los cupos no pueden ser menos."]);
        }

        $curso->update($request->validated());

        return redirect()->route('cursos.show', $curso)->with('success', 'Curso actualizado.');
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();        // sus matrículas se borran por el cascade de la pivote

        return redirect()->route('cursos.index')->with('success', 'Curso eliminado.');
    }
    public function show(Curso $curso){
        $curso->load(['categoria', 'estudiantes' => fn ($q) => $q->orderBy('apellidos')]);

        // Estudiantes que AÚN no están en este curso (para el select de matrícula)
        $disponibles = Estudiante::whereDoesntHave('cursos', fn ($q) => $q->where('cursos.id', $curso->id))
            ->orderBy('apellidos')
            ->get();

        // 3 cursos publicados de la misma categoría, sin el actual, más recientes
        $sugerencias = Curso::publicados()
            ->where('categoria_id', $curso->categoria_id)
            ->where('id', '!=', $curso->id)
            ->latest()
            ->take(3)
            ->get();

        // Estadísticas sobre la colección ya cargada (sin más consultas)
        $conNota   = $curso->estudiantes->whereNotNull('pivot.nota');
        $promedio  = $conNota->avg('pivot.nota');                   // null si nadie tiene nota
        $aprobados = $conNota->where('pivot.nota', '>=', 11)->count();

        return view('cursos.show', compact('curso', 'disponibles', 'sugerencias', 'promedio', 'aprobados'));
    }
}
