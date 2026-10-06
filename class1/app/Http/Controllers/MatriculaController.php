<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MatriculaController extends Controller
{
    // POST /cursos/{curso}/matriculas  →  attach con datos en el pivote
    public function store(Request $request, Curso $curso)
    {
        $request->validate([
            'estudiante_id' => [
                'required',
                'exists:estudiantes,id',
                // unique combinado: no puede existir (estudiante_id, este curso_id)
                Rule::unique('matriculas')->where(fn ($q) => $q->where('curso_id', $curso->id)),
            ],
        ], [
            'estudiante_id.required' => 'Selecciona un estudiante.',
            'estudiante_id.unique'   => 'El estudiante ya está matriculado en este curso.',
        ]);

        if (! $curso->publicado) {
            return back()->with('error', 'Solo se puede matricular en cursos publicados.');
        }

        if ($curso->cuposDisponibles() <= 0) {
            return back()->with('error', 'El curso no tiene cupos disponibles.');
        }

        $curso->estudiantes()->attach($request->estudiante_id, [
            'fecha_matricula' => now()->toDateString(),
        ]);

        return back()->with('success', 'Estudiante matriculado correctamente.');
    }

    // PUT /cursos/{curso}/notas  →  updateExistingPivot por cada estudiante
    public function notas(Request $request, Curso $curso)
    {
        $request->validate([
            'notas'   => ['required', 'array'],
            'notas.*' => ['nullable', 'numeric', 'between:0,20'],
        ], [
            'notas.*.numeric' => 'Las notas deben ser números.',
            'notas.*.between' => 'Cada nota debe estar entre 0 y 20.',
        ]);

        // notas llega como [estudiante_id => nota]
        foreach ($request->notas as $estudianteId => $nota) {
            $curso->estudiantes()->updateExistingPivot($estudianteId, ['nota' => $nota]);
        }

        return back()->with('success', 'Notas registradas.');
    }

    // DELETE /cursos/{curso}/matriculas/{estudiante}  →  detach
    public function destroy(Curso $curso, Estudiante $estudiante)
    {
        $curso->estudiantes()->detach($estudiante->id);

        return back()->with('success', "{$estudiante->nombres} {$estudiante->apellidos} fue retirado del curso.");
    }
}
