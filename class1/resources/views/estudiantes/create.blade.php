{{-- create.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Nuevo estudiante')

@section('content')
    <h1 class="h3 mb-3">Nuevo estudiante</h1>
    <div class="card"><div class="card-body">
        <form method="POST" action="{{ route('estudiantes.store') }}">
            @csrf
            @include('estudiantes._form')
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div></div>
@endsection
