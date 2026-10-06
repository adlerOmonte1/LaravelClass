{{-- edit.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Editar estudiante')

@section('content')
    <h1 class="h3 mb-3">Editar: {{ $estudiante->nombres }} {{ $estudiante->apellidos }}</h1>
    <div class="card"><div class="card-body">
        <form method="POST" action="{{ route('estudiantes.update', $estudiante) }}">
            @csrf
            @method('PUT')
            @include('estudiantes._form')
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('estudiantes.show', $estudiante) }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div></div>
@endsection
