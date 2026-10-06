@extends('layouts.app')

@section('titulo', 'Nuevo curso')

@section('contenido')
    <h1 class="h3 mb-3">Registrar curso</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('cursos.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ old('titulo') }}">
            @error('titulo') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
            @error('descripcion') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Select FIJO: las opciones están escritas en la vista --}}
        <div class="mb-3">
            <label class="form-label">Nivel</label>
            <select name="nivel" class="form-select">
                <option value="">-- Seleccione --</option>
                @foreach (['Basico', 'Intermedio', 'Avanzado'] as $nivel)
                    <option value="{{ $nivel }}" @selected(old('nivel') == $nivel)>{{ $nivel }}</option>
                @endforeach
            </select>
            @error('nivel') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Select DINÁMICO: las opciones vienen de la BD --}}
        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="category_id" class="form-select">
                <option value="">-- Seleccione --</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" @selected(old('category_id') == $categoria->id)>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="publicado" value="1" id="publicado"
                   class="form-check-input" @checked(old('publicado'))>
            <label class="form-check-label" for="publicado">Publicado</label>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
