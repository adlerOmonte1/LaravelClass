@extends('layouts.app')

@section('titulo', $curso->titulo)

@section('content')
    {{-- Encabezado --}}
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h1 class="h3 mb-1">
                {{ $curso->titulo }}
                @if ($curso->publicado)
                    <span class="badge bg-success fs-6">Publicado</span>
                @else
                    <span class="badge bg-secondary fs-6">Borrador</span>
                @endif
            </h1>
            <p class="text-muted mb-0">
                {{ $curso->codigo }} ·
                <a href="{{ route('categorias.show', $curso->categoria) }}">{{ $curso->categoria->nombre }}</a> ·
                {{ $curso->nivel }} · {{ $curso->creditos }} créditos ·
                inicia el {{ $curso->fecha_inicio->format('d/m/Y') }}
            </p>
        </div>
        <a href="{{ route('cursos.edit', $curso) }}" class="btn btn-warning">Editar</a>
    </div>

    <p>{{ $curso->descripcion }}</p>

    {{-- Indicadores --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3"><div class="card"><div class="card-body">
            <div class="text-muted small">Matriculados</div>
            <div class="fs-4 fw-bold">{{ $curso->estudiantes->count() }} / {{ $curso->cupos }}</div>
        </div></div></div>
        <div class="col-6 col-md-3"><div class="card"><div class="card-body">
            <div class="text-muted small">Cupos libres</div>
            <div class="fs-4 fw-bold">{{ $curso->cupos - $curso->estudiantes->count() }}</div>
        </div></div></div>
        <div class="col-6 col-md-3"><div class="card"><div class="card-body">
            <div class="text-muted small">Promedio</div>
            <div class="fs-4 fw-bold">{{ $promedio !== null ? number_format($promedio, 2) : '—' }}</div>
        </div></div></div>
        <div class="col-6 col-md-3"><div class="card"><div class="card-body">
            <div class="text-muted small">Aprobados (nota ≥ 11)</div>
            <div class="fs-4 fw-bold">{{ $aprobados }}</div>
        </div></div></div>
    </div>

    {{-- Matricular (attach) --}}
    <div class="card mb-4">
        <div class="card-header">Matricular estudiante</div>
        <div class="card-body">
            @if (! $curso->publicado)
                <p class="text-muted mb-0">Publica el curso para poder matricular estudiantes.</p>
            @elseif ($curso->estudiantes->count() >= $curso->cupos)
                <p class="text-danger mb-0">No hay cupos disponibles.</p>
            @else
                <form method="POST" action="{{ route('matriculas.store', $curso) }}" class="row g-2">
                    @csrf
                    <div class="col-md-9">
                        <select name="estudiante_id" class="form-select @error('estudiante_id') is-invalid @enderror">
                            <option value="">-- Seleccione un estudiante --</option>
                            @foreach ($disponibles as $estudiante)
                                <option value="{{ $estudiante->id }}" @selected(old('estudiante_id') == $estudiante->id)>
                                    {{ $estudiante->apellidos }}, {{ $estudiante->nombres }} ({{ $estudiante->codigo }})
                                </option>
                            @endforeach
                        </select>
                        @error('estudiante_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success w-100">Matricular</button>
                    </div>
                </form>
            @endif
        </div>
    </div>

    {{-- Matriculados + notas (updateExistingPivot) + retirar (detach) --}}
    <h2 class="h5">Estudiantes matriculados</h2>
    <form method="POST" action="{{ route('matriculas.notas', $curso) }}">
        @csrf
        @method('PUT')
        <table class="table bg-white align-middle">
            <thead>
                <tr><th>#</th><th>Estudiante</th><th>Matrícula</th><th style="width: 140px">Nota (0-20)</th><th>Estado</th><th></th></tr>
            </thead>
            <tbody>
                @forelse ($curso->estudiantes as $estudiante)
                    @php $nota = $estudiante->pivot->nota; @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('estudiantes.show', $estudiante) }}">
                                {{ $estudiante->apellidos }}, {{ $estudiante->nombres }}
                            </a>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($estudiante->pivot->fecha_matricula)->format('d/m/Y') }}</td>
                        <td>
                            <input type="number" step="0.01" min="0" max="20"
                                   name="notas[{{ $estudiante->id }}]"
                                   class="form-control form-control-sm @error('notas.' . $estudiante->id) is-invalid @enderror"
                                   value="{{ old('notas.' . $estudiante->id, $nota) }}">
                        </td>
                        <td>
                            @if (is_null($nota))
                                <span class="badge bg-secondary">Pendiente</span>
                            @elseif ($nota >= 11)
                                <span class="badge bg-success">Aprobado</span>
                            @else
                                <span class="badge bg-danger">Desaprobado</span>
                            @endif
                        </td>
                        <td class="text-end">
                            {{-- Un form NO puede ir dentro de otro: el botón envía el form de abajo con el atributo form --}}
                            <button type="submit" form="retirar-{{ $estudiante->id }}" class="btn btn-sm btn-outline-danger">Retirar</button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">Aún no hay estudiantes matriculados.</td></tr>
                @endforelse
            </tbody>
        </table>

        @if ($curso->estudiantes->isNotEmpty())
            <button type="submit" class="btn btn-primary">Guardar notas</button>
        @endif
    </form>

    {{-- Formularios de retiro, FUERA del form de notas --}}
    @foreach ($curso->estudiantes as $estudiante)
        <form id="retirar-{{ $estudiante->id }}" method="POST" class="d-none"
              action="{{ route('matriculas.destroy', [$curso, $estudiante]) }}"
              onsubmit="return confirm('¿Retirar a este estudiante del curso?')">
            @csrf
            @method('DELETE')
        </form>
    @endforeach

    {{-- Sugerencias --}}
    <h2 class="h5 mt-4">Otros cursos de {{ $curso->categoria->nombre }}</h2>
    <div class="row g-3">
        @forelse ($sugerencias as $sugerido)
            <div class="col-md-4">
                <div class="card h-100"><div class="card-body">
                    <h3 class="h6"><a href="{{ route('cursos.show', $sugerido) }}">{{ $sugerido->titulo }}</a></h3>
                    <small class="text-muted">{{ $sugerido->nivel }} · {{ $sugerido->creditos }} créditos</small>
                </div></div>
            </div>
        @empty
            <p class="text-muted">No hay otros cursos publicados en esta categoría.</p>
        @endforelse
    </div>

    <a href="{{ route('cursos.index') }}" class="btn btn-secondary mt-4">Volver a cursos</a>
@endsection
