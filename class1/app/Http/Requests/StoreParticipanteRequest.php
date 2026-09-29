<?php

namespace App\Http\Requests;

use App\Rules\DniValido;
use Illuminate\Foundation\Http\FormRequest;

class StoreParticipanteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;   // si es false → 403
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nombres' => trim((string) $this->nombres),
            'apellidos'=> trim((string) $this->apellidos),
            'dni' => trim((string) $this->dni),
            'correo' => strtolower(trim((string) $this->correo)),
            'es_estudiante'=> $this->boolean('es_estudiante'),
        ]);
    }

    public function rules(): array
    {
        return [
            'nombres' => 'required|string|min:3|max:60',
            'apellidos' => 'required|string|min:3|max:60',
            'dni' => ['bail', 'required', 'digits:8', new DniValido, 'unique:participantes,dni'],
            'correo'  => 'required|email|max:100|unique:participantes,correo',
            'celular'  => 'nullable|regex:/^9\d{8}$/',
            'fecha_nacimiento' => 'required|date|before:today|before_or_equal:' . now()->subYears(16)->toDateString(),
            'modalidad'=> 'required|in:presencial,virtual',
            'es_estudiante' => 'boolean',
            'codigo_estudiante' => 'exclude_unless:es_estudiante,1|required|digits:9',
            'ciclo' => 'exclude_unless:es_estudiante,1|required|integer|between:1,10',
            'acepta_terminos'=> 'accepted',
        ];
    }

    public function mensajes(): array
    {
        return [
        'required' => 'El campo :attribute es obligatorio.',
        'min'  => 'El campo :attribute debe tener al menos :min caracteres.',
        'max'  => 'El campo :attribute no debe superar :max caracteres.',
        'dni.digits'  => 'El :attribute debe tener exactamente 8 dígitos.',
        'dni.unique' => 'Este :attribute ya está inscrito.',
        'correo.email'=> 'El :attribute no tiene un formato válido.',
        'correo.unique' => 'Este :attribute ya está registrado.',
        'celular.regex'  => 'El :attribute debe tener 9 dígitos y empezar con 9.',
        'fecha_nacimiento.date' => 'La :attribute no es una fecha válida.',
        'fecha_nacimiento.before' => 'La :attribute debe ser anterior a hoy.',
        'fecha_nacimiento.before_or_equal' => 'Debes tener al menos 16 años para inscribirte.',
        'modalidad.in' => 'La :attribute solo puede ser presencial o virtual.',
        'codigo_estudiante.required' => 'El :attribute es obligatorio si eres estudiante.',
        'codigo_estudiante.digits'  => 'El :attribute debe tener 9 dígitos.',
        'ciclo.required' => 'El :attribute es obligatorio si eres estudiante.',
        'ciclo.between' => 'El :attribute debe estar entre 1 y 10.',
        'acepta_terminos.accepted' => 'Debes aceptar los términos y condiciones.',
    ];
    }

    public function atributos(): array
    {
        return [
            'nombres'=> 'nombres',
            'apellidos' => 'apellidos',
            'dni' => 'número de DNI',
            'correo' => 'correo electrónico',
            'celular' => 'número de celular',
            'fecha_nacimiento' => 'fecha de nacimiento',
            'modalidad' => 'modalidad',
            'codigo_estudiante' => 'código de estudiante',
            'ciclo'  => 'ciclo',
            'acepta_terminos'=> 'términos y condiciones',
        ];
    }
}