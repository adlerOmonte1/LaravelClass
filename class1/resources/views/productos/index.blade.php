@extends('layouts.app')

@section('content')
    <h1>Productos</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table>
        <tr><th>Nombre</th><th>Precio</th><th>Stock</th><th>Categoría</th><th></th></tr>
        @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->precio }}</td>
                <td>{{ $producto->stock }}</td>
                <td>{{ $producto->categoria->nombre }}</td>
                <td>
                    <form action="{{ route('productos.destroy', $producto) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection