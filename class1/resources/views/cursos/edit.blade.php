{{-- edit.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Editar curso')

@section('content')
    <h1 class="h3 mb-3">Editar: {{ $curso->titulo }}</h1>
    <div class="card"><div class="card-body">
        <form method="POST" action="{{ route('cursos.update', $curso) }}">
            @csrf
            @method('PUT')
            @include('cursos._form')
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('cursos.show', $curso) }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div></div>
@endsection
