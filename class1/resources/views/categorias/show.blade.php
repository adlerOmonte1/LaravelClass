@extends('layouts.app')

@section('titulo', $categoria->nombre)

@section('content')
    <h1 class="h3">{{ $categoria->nombre }}</h1>
    <p class="text-muted">{{ $categoria->descripcion ?? 'Sin descripción.' }}</p>

    <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="h5 mb-0">Cursos ({{ $cursos->count() }})</h2>
        {{-- Envía ?categoria_id=X para dejarla preseleccionada en el formulario --}}
        <a href="{{ route('cursos.create', ['categoria_id' => $categoria->id]) }}" class="btn btn-sm btn-primary">Agregar curso</a>
    </div>

    <table class="table table-hover bg-white">
        <thead><tr><th>Código</th><th>Título</th><th>Nivel</th><th>Matriculados</th><th>Estado</th></tr></thead>
        <tbody>
            @forelse ($cursos as $curso)
                <tr>
                    <td>{{ $curso->codigo }}</td>
                    <td><a href="{{ route('cursos.show', $curso) }}">{{ $curso->titulo }}</a></td>
                    <td>{{ $curso->nivel }}</td>
                    <td>{{ $curso->estudiantes_count }} / {{ $curso->cupos }}</td>
                    <td>
                        @if ($curso->publicado)
                            <span class="badge bg-success">Publicado</span>
                        @else
                            <span class="badge bg-secondary">Borrador</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Esta categoría aún no tiene cursos.</td></tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Volver</a>
@endsection
