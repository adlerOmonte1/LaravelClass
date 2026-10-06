@extends('layouts.app')

@section('titulo', 'Categorías')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Categorías</h1>
        <a href="{{ route('categorias.create') }}" class="btn btn-primary">Nueva categoría</a>
    </div>

    <form method="GET" action="{{ route('categorias.index') }}" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control" placeholder="Buscar por nombre">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-outline-primary">Buscar</button>
            <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary">Limpiar</a>
        </div>
    </form>

    <table class="table table-hover bg-white">
        <thead class="table-dark">
            <tr><th>#</th><th>Nombre</th><th>Descripción</th><th>Cursos</th><th class="text-end">Acciones</th></tr>
        </thead>
        <tbody>
            @forelse ($categorias as $categoria)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $categoria->nombre }}</td>
                    <td>{{ $categoria->descripcion ? Str::limit($categoria->descripcion, 50) : '—' }}</td>
                    <td><span class="badge bg-secondary">{{ $categoria->cursos_count }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('categorias.show', $categoria) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Eliminar esta categoría?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">No se encontraron categorías.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
