@extends('layouts.app')

@section('titulo', 'Cursos')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Cursos <small class="text-muted fs-6">({{ $cursos->total() }})</small></h1>
        <a href="{{ route('cursos.create') }}" class="btn btn-primary">Nuevo curso</a>
    </div>

    <form method="GET" action="{{ route('cursos.index') }}" class="row g-2 mb-3">
        <div class="col-md-3">
            <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control" placeholder="Título o código">
        </div>
        <div class="col-md-3">
            <select name="categoria" class="form-select">
                <option value="">Todas las categorías</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" @selected(request('categoria') == $categoria->id)>{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select name="nivel" class="form-select">
                <option value="">Todos los niveles</option>
                @foreach (App\Models\Curso::NIVELES as $nivel)
                    <option value="{{ $nivel }}" @selected(request('nivel') == $nivel)>{{ $nivel }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-center">
            <div class="form-check">
                <input type="checkbox" name="solo_publicados" value="1" id="solo_publicados" class="form-check-input"
                       @checked(request()->boolean('solo_publicados'))>
                <label for="solo_publicados" class="form-check-label">Solo publicados</label>
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary">Filtrar</button>
            <a href="{{ route('cursos.index') }}" class="btn btn-outline-secondary">Limpiar</a>
        </div>
    </form>

    <table class="table table-hover bg-white align-middle">
        <thead class="table-dark">
            <tr>
                <th>Código</th><th>Título</th><th>Categoría</th><th>Nivel</th>
                <th>Matriculados</th><th>Inicio</th><th>Estado</th><th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cursos as $curso)
                <tr>
                    <td>{{ $curso->codigo }}</td>
                    <td>{{ $curso->titulo }}</td>
                    <td>{{ $curso->categoria->nombre }}</td>
                    <td>{{ $curso->nivel }}</td>
                    <td>{{ $curso->estudiantes_count }} / {{ $curso->cupos }}</td>
                    <td>{{ $curso->fecha_inicio->format('d/m/Y') }}</td>
                    <td>
                        @if ($curso->publicado)
                            <span class="badge bg-success">Publicado</span>
                        @else
                            <span class="badge bg-secondary">Borrador</span>
                        @endif
                    </td>
                    <td class="text-end text-nowrap">
                        <a href="{{ route('cursos.show', $curso) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('cursos.edit', $curso) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('cursos.destroy', $curso) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Eliminar el curso y sus matrículas?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center">No hay cursos con esos filtros.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $cursos->links() }}
@endsection
