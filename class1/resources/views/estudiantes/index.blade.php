@extends('layouts.app')

@section('titulo', 'Estudiantes')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Estudiantes <small class="text-muted fs-6">({{ $estudiantes->total() }})</small></h1>
        <a href="{{ route('estudiantes.create') }}" class="btn btn-primary">Nuevo estudiante</a>
    </div>

    <form method="GET" action="{{ route('estudiantes.index') }}" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control"
                   placeholder="Apellidos, nombres, DNI o código">
        </div>
        <div class="col-md-3">
            <select name="modalidad" class="form-select">
                <option value="">Todas las modalidades</option>
                <option value="presencial" @selected(request('modalidad') == 'presencial')>Presencial</option>
                <option value="virtual" @selected(request('modalidad') == 'virtual')>Virtual</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-outline-primary">Filtrar</button>
            <a href="{{ route('estudiantes.index') }}" class="btn btn-outline-secondary">Limpiar</a>
        </div>
    </form>

    <table class="table table-hover bg-white align-middle">
        <thead class="table-dark">
            <tr>
                <th>Código</th><th>Estudiante</th><th>DNI</th><th>Correo</th>
                <th>Modalidad</th><th>Celular</th><th>Cursos</th><th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($estudiantes as $estudiante)
                <tr>
                    <td>{{ $estudiante->codigo }}</td>
                    <td>{{ $estudiante->apellidos }}, {{ $estudiante->nombres }}</td>
                    <td>{{ $estudiante->dni }}</td>
                    <td>{{ $estudiante->email }}</td>
                    <td>{{ ucfirst($estudiante->modalidad) }}</td>
                    <td>{{ $estudiante->perfil?->celular ?? '—' }}</td>
                    <td><span class="badge bg-secondary">{{ $estudiante->cursos_count }}</span></td>
                    <td class="text-end text-nowrap">
                        <a href="{{ route('estudiantes.show', $estudiante) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('estudiantes.edit', $estudiante) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('estudiantes.destroy', $estudiante) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Eliminar al estudiante, su perfil y sus matrículas?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center">No se encontraron estudiantes.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $estudiantes->links() }}
@endsection
