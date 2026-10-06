<?php

namespace App\Http\Requests;

use App\Rules\DniValido;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EstudianteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'email' => strtolower(trim((string) $this->email)),
            'dni'   => trim((string) $this->dni),
        ]);
    }

    public function rules(): array
    {
        $estudianteId = $this->route('estudiante')?->id;     // null al crear

        return [
            // Datos del estudiante
            'codigo'           => ['required', 'digits:10', Rule::unique('estudiantes', 'codigo')->ignore($estudianteId)],
            'dni'              => ['required', new DniValido, Rule::unique('estudiantes', 'dni')->ignore($estudianteId)],
            'nombres'          => ['required', 'string', 'min:2', 'max:60'],
            'apellidos'        => ['required', 'string', 'min:2', 'max:60'],
            'email'            => ['required', 'email', 'max:100', Rule::unique('estudiantes', 'email')->ignore($estudianteId)],
            'fecha_nacimiento' => ['required', 'date', 'before_or_equal:' . now()->subYears(16)->toDateString()],
            'modalidad'        => ['required', Rule::in(['presencial', 'virtual'])],

            // Perfil (1:1)
            'celular'   => ['nullable', 'regex:/^9\d{8}$/'],
            'direccion' => ['nullable', 'string', 'max:150'],
            'biografia' => ['nullable', 'string', 'max:500'],

            // Cursos (N:M)
            'cursos'   => ['nullable', 'array'],
            'cursos.*' => ['integer', 'exists:cursos,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'required'                         => 'El campo :attribute es obligatorio.',
            'codigo.digits'                    => 'El código debe tener exactamente 10 dígitos.',
            'codigo.unique'                    => 'Ese código ya está registrado.',
            'dni.unique'                       => 'Ese DNI ya está registrado.',
            'email.email'                      => 'Ingresa un correo válido.',
            'email.unique'                     => 'Ese correo ya está registrado.',
            'fecha_nacimiento.before_or_equal' => 'El estudiante debe tener al menos 16 años.',
            'modalidad.in'                     => 'La modalidad debe ser presencial o virtual.',
            'celular.regex'                    => 'El celular debe tener 9 dígitos y empezar con 9.',
            'cursos.*.exists'                  => 'Uno de los cursos seleccionados no existe.',
        ];
    }

    public function attributes(): array
    {
        return [
            'codigo'           => 'código',
            'dni'              => 'número de DNI',
            'email'            => 'correo',
            'fecha_nacimiento' => 'fecha de nacimiento',
            'direccion'        => 'dirección',
            'biografia'        => 'biografía',
        ];
    }
}
