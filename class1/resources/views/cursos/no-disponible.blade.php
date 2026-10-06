@extends('layouts.app')

@section('titulo', 'No disponible')

@section('contenido')
    <div class="alert alert-warning">
        <h1 class="h4">Curso no disponible</h1>
        <p class="mb-0">El curso que buscas no existe o aún no está publicado.</p>
    </div>
    <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Volver a la lista</a>
@endsection
