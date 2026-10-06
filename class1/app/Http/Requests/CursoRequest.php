<?php

namespace App\Http\Requests;

use App\Models\Curso;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CursoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;            // si fuera false: error 403
    }

    // Normaliza ANTES de validar
    protected function prepareForValidation(): void
    {
        $this->merge([
            'codigo'    => strtoupper(trim((string) $this->codigo)),
            'publicado' => $this->boolean('publicado'),
        ]);
    }

    public function rules(): array
    {
        $cursoId = $this->route('curso')?->id;      // null en store, id en update

        return [
            'categoria_id' => ['required', 'exists:categorias,id'],
            'codigo'       => ['required', 'string', 'max:10', Rule::unique('cursos', 'codigo')->ignore($cursoId)],
            'titulo'       => ['required', 'string', 'min:3', 'max:150'],
            'descripcion'  => ['required', 'string', 'min:10'],
            'nivel'        => ['required', Rule::in(Curso::NIVELES)],
            'creditos'     => ['required', 'integer', 'between:1,6'],
            'cupos'        => ['required', 'integer', 'between:1,60'],
            'fecha_inicio' => ['required', 'date'],
            'publicado'    => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'required'            => 'El campo :attribute es obligatorio.',
            'between'             => 'El campo :attribute debe estar entre :min y :max.',
            'codigo.unique'       => 'Ya existe un curso con ese código.',
            'nivel.in'            => 'El nivel debe ser Basico, Intermedio o Avanzado.',
            'categoria_id.exists' => 'La categoría seleccionada no existe.',
            'descripcion.min'     => 'La descripción debe tener al menos 10 caracteres.',
        ];
    }

    public function attributes(): array
    {
        return [
            'categoria_id' => 'categoría',
            'codigo'       => 'código',
            'titulo'       => 'título',
            'descripcion'  => 'descripción',
            'creditos'     => 'créditos',
            'fecha_inicio' => 'fecha de inicio',
        ];
    }
}
