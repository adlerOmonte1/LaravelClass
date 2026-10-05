@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded shadow-sm">
        <div>
            <h4 class="mb-0">Bienvenido, {{ Auth::user()->name }}</h4>
            <small class="text-muted">Listado de cursos disponibles</small>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Cerrar sesión</button>
        </form>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between">
            <span>Cursos</span>
            <span class="badge bg-light text-primary">{{ $cursos->count() }} registros</span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Nivel</th>
                            <th>Categoría</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cursos as $curso)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $curso->titulo }}</td>
                                <td>{{ Str::limit($curso->descripcion, 80) }}</td>
                                <td>
                                    <span class="badge
                                        @switch($curso->nivel)
                                            @case('Básico') bg-success @break
                                            @case('Intermedio') bg-warning text-dark @break
                                            @default bg-danger
                                        @endswitch">
                                        {{ $curso->nivel }}
                                    </span>
                                </td>
                                <td>{{ $curso->categoria->nombre }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No hay cursos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection