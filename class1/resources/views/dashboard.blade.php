@extends('layouts.app')

@section('titulo', 'Inicio')

@section('content')
    <h1 class="h3 mb-4">Bienvenido, {{ Auth::user()->name }}</h1>

    @php
        $tarjetas = [
            'Categorías'  => $totalCategorias,
            'Cursos'      => $totalCursos,
            'Publicados'  => $totalPublicados,
            'Estudiantes' => $totalEstudiantes,
            'Matrículas'  => $totalMatriculas,
        ];
    @endphp

    <div class="row g-3 mb-4">
        @foreach ($tarjetas as $texto => $valor)
            <div class="col-6 col-md">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <div class="fs-2 fw-bold">{{ $valor }}</div>
                        <div class="text-muted">{{ $texto }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <h2 class="h5">Últimos cursos</h2>
            <table class="table table-sm table-hover bg-white">
                <thead><tr><th>Código</th><th>Título</th><th>Categoría</th><th>Inicio</th></tr></thead>
                <tbody>
                    @forelse ($ultimosCursos as $curso)
                        <tr>
                            <td>{{ $curso->codigo }}</td>
                            <td><a href="{{ route('cursos.show', $curso) }}">{{ $curso->titulo }}</a></td>
                            <td>{{ $curso->categoria->nombre }}</td>
                            <td>{{ $curso->fecha_inicio->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4">Aún no hay cursos.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="col-md-4">
            <h2 class="h5">Cursos por categoría</h2>
            <ul class="list-group">
                @foreach ($categorias as $categoria)
                    <li class="list-group-item d-flex justify-content-between">
                        <a href="{{ route('categorias.show', $categoria) }}">{{ $categoria->nombre }}</a>
                        <span class="badge bg-primary rounded-pill">{{ $categoria->cursos_count }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
