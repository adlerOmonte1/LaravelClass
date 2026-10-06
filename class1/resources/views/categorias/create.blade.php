{{-- create.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Nueva categoría')

@section('content')
    <h1 class="h3 mb-3">Nueva categoría</h1>
    <div class="card"><div class="card-body">
        <form method="POST" action="{{ route('categorias.store') }}">
            @csrf
            @include('categorias._form')
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div></div>
@endsection
