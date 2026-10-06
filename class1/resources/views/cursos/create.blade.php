{{-- create.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Nuevo curso')

@section('content')
    <h1 class="h3 mb-3">Nuevo curso</h1>
    <div class="card"><div class="card-body">
        <form method="POST" action="{{ route('cursos.store') }}">
            @csrf
            @include('cursos._form')
            <div class="mt-3">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div></div>
@endsection
