@extends('layouts.app')

@section('titulo', $estudiante->nombres)

@section('content')
    <div class="d-flex justify-content-between align-items-start mb-3">
        <h1 class="h3">{{ $estudiante->nombres }} {{ $estudiante->apellidos }}</h1>
        <a href="{{ route('estudiantes.edit', $estudiante) }}" class="btn btn-warning">Editar</a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">Datos</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Código: {{ $estudiante->codigo }}</li>
                    <li class="list-group-item">DNI: {{ $estudiante->dni }}</li>
                    <li class="list-group-item">Correo: {{ $estudiante->email }}</li>
                    <li class="list-group-item">
                        Nacimiento: {{ $estudiante->fecha_nacimiento->format('d/m/Y') }}
                        ({{ $estudiante->fecha_nacimiento->age }} años)
                    </li>
                    <li class="list-group-item">Modalidad: {{ ucfirst($estudiante->modalidad) }}</li>
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">Perfil (1:1)</div>
                @if ($estudiante->perfil)
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Celular: {{ $estudiante->perfil->celular ?? 'No registrado' }}</li>
                        <li class="list-group-item">Dirección: {{ $estudiante->perfil->direccion ?? 'No registrada' }}</li>
                        <li class="list-group-item">Biografía: {{ $estudiante->perfil->biografia ?? '—' }}</li>
                    </ul>
                @else
                    <div class="card-body text-muted">Sin perfil registrado.</div>
                @endif
            </div>
        </div>
    </div>

    <h2 class="h5">
        Cursos (N:M)
        <small class="text-muted">· promedio: {{ $promedio !== null ? number_format($promedio, 2) : '—' }}</small>
    </h2>
    <table class="table bg-white align-middle">
        <thead><tr><th>Curso</th><th>Categoría</th><th>Matrícula</th><th>Nota</th><th>Estado</th></tr></thead>
        <tbody>
            @forelse ($estudiante->cursos as $curso)
                @php $nota = $curso->pivot->nota; @endphp
                <tr>
                    <td><a href="{{ route('cursos.show', $curso) }}">{{ $curso->titulo }}</a></td>
                    <td>{{ $curso->categoria->nombre }}</td>
                    <td>{{ \Carbon\Carbon::parse($curso->pivot->fecha_matricula)->format('d/m/Y') }}</td>
                    <td>{{ $nota ?? '—' }}</td>
                    <td>
                        @if (is_null($nota))
                            <span class="badge bg-secondary">Pendiente</span>
                        @elseif ($nota >= 11)
                            <span class="badge bg-success">Aprobado</span>
                        @else
                            <span class="badge bg-danger">Desaprobado</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">No está matriculado en ningún curso.</td></tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">Volver</a>
@endsection
