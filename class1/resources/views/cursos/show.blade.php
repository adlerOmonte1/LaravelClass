@extends('layouts.app')

@section('titulo', $curso->titulo)

@section('contenido')
    <div class="card mb-4">
        <div class="card-body">
            <h1 class="h3">{{ $curso->titulo }}</h1>
            <p class="text-muted mb-2">
                Categoría: <strong>{{ $curso->categoria->nombre }}</strong> |
                Nivel: {{ $curso->nivel }}
            </p>
            <p>{{ $curso->descripcion }}</p>
        </div>
    </div>

    <h2 class="h5">Otros cursos de {{ $curso->categoria->nombre }}</h2>
    @forelse ($sugerencias as $sugerido)
        <div class="border rounded p-2 mb-2">
            <a href="{{ route('cursos.show', $sugerido) }}">{{ $sugerido->titulo }}</a>
            <small class="text-muted">({{ $sugerido->nivel }})</small>
        </div>
    @empty
        <p>No hay otros cursos publicados en esta categoría.</p>
    @endforelse

    <a href="{{ route('cursos.index') }}" class="btn btn-secondary mt-3">Volver</a>
@endsection
