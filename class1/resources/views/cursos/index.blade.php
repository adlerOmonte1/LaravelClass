@extends('layouts.app')

@section('titulo', 'Lista de cursos')

@section('contenido')
    <h1 class="h3 mb-3">Cursos</h1>

    {{-- Form GET: los datos viajan en la URL (?categoria=2). No necesita @csrf --}}
    <form method="GET" action="{{ route('cursos.index') }}" class="row g-2 mb-3">
        <div class="col-auto">
            <select name="categoria" class="form-select">
                <option value="">-- Todas las categorías --</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" @selected(request('categoria') == $categoria->id)>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Limpiar</a>
        </div>
    </form>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Título</th>
                <th>Categoría</th>
                <th>Nivel</th>
                <th>Publicado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cursos as $curso)
                <tr>
                    <td><a href="{{ route('cursos.show', $curso) }}">{{ $curso->titulo }}</a></td>
                    <td>{{ $curso->categoria->nombre }}</td>
                    <td>{{ $curso->nivel }}</td>
                    <td>{{ $curso->publicado ? 'Sí' : 'No' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No existen cursos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
