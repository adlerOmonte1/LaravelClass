<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstudianteRequest;
use App\Models\Curso;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{
    private const CAMPOS_ESTUDIANTE = ['codigo', 'dni', 'nombres', 'apellidos', 'email', 'fecha_nacimiento', 'modalidad'];
    private const CAMPOS_PERFIL     = ['celular', 'direccion', 'biografia'];

    public function index(Request $request)
    {
        $estudiantes = Estudiante::with('perfil')
            ->withCount('cursos')
            ->when($request->filled('buscar'), function ($q) use ($request) {
                $q->where(function ($sub) use ($request) {
                    $sub->where('apellidos', 'like', '%' . $request->buscar . '%')
                        ->orWhere('nombres', 'like', '%' . $request->buscar . '%')
                        ->orWhere('dni', $request->buscar)
                        ->orWhere('codigo', $request->buscar);
                });
            })
            ->when($request->filled('modalidad'), fn ($q) => $q->where('modalidad', $request->modalidad))
            ->orderBy('apellidos')
            ->paginate(10)
            ->withQueryString();

        return view('estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        return view('estudiantes.create', [
            'estudiante'    => new Estudiante,
            'cursos'        => Curso::publicados()->orderBy('titulo')->get(),
            'seleccionados' => [],
        ]);
    }

    public function store(EstudianteRequest $request)
    {
        $estudiante = DB::transaction(function () use ($request) {
            // 1. Estudiante (solo campos validados)
            $estudiante = Estudiante::create($request->safe()->only(self::CAMPOS_ESTUDIANTE));

            // 2. Perfil 1:1: create desde la relación pone estudiante_id solo
            $estudiante->perfil()->create($request->safe()->only(self::CAMPOS_PERFIL));

            // 3. Cursos N:M: attach con la fecha en el pivote
            foreach ($request->validated('cursos', []) as $cursoId) {
                $estudiante->cursos()->attach($cursoId, ['fecha_matricula' => now()->toDateString()]);
            }

            return $estudiante;
        });

        return redirect()->route('estudiantes.show', $estudiante)
                         ->with('success', 'Estudiante registrado correctamente.');
    }

    public function show(Estudiante $estudiante)
    {
        $estudiante->load(['perfil', 'cursos.categoria']);
        $promedio = $estudiante->cursos->whereNotNull('pivot.nota')->avg('pivot.nota');

        return view('estudiantes.show', compact('estudiante', 'promedio'));
    }

    public function edit(Estudiante $estudiante)
    {
        $estudiante->load('perfil');
        $seleccionados = $estudiante->cursos()->pluck('cursos.id')->all();

        // Publicados + los que ya tiene (aunque luego se hayan despublicado)
        $cursos = Curso::where('publicado', true)
            ->orWhereIn('id', $seleccionados)
            ->orderBy('titulo')
            ->get();

        return view('estudiantes.edit', compact('estudiante', 'cursos', 'seleccionados'));
    }

    public function update(EstudianteRequest $request, Estudiante $estudiante)
    {
        DB::transaction(function () use ($request, $estudiante) {
            $estudiante->update($request->safe()->only(self::CAMPOS_ESTUDIANTE));

            // 1:1: actualiza el perfil o lo crea si no existía
            $estudiante->perfil()->updateOrCreate([], $request->safe()->only(self::CAMPOS_PERFIL));

            // N:M: quita los desmarcados y agrega los nuevos.
            // Los que se mantienen conservan su fecha y su nota (sync con datos las pisaría).
            $nuevos   = array_map('intval', $request->validated('cursos', []));
            $actuales = $estudiante->cursos()->pluck('cursos.id')->all();

            $estudiante->cursos()->detach(array_diff($actuales, $nuevos));   // arreglo vacío = no borra nada

            foreach (array_diff($nuevos, $actuales) as $cursoId) {
                $estudiante->cursos()->attach($cursoId, ['fecha_matricula' => now()->toDateString()]);
            }
        });

        return redirect()->route('estudiantes.show', $estudiante)->with('success', 'Estudiante actualizado.');
    }

    public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();     // perfil y matrículas se borran por el cascade

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado.');
    }
}
