{{-- edit.blade.php --}}
@extends('layouts.app')

@section('titulo', 'Editar categoría')

@section('content')
    <h1 class="h3 mb-3">Editar: {{ $categoria->nombre }}</h1>
    <div class="card"><div class="card-body">
        <form method="POST" action="{{ route('categorias.update', $categoria) }}">
            @csrf
            @method('PUT')
            @include('categorias._form')
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div></div>
@endsection
