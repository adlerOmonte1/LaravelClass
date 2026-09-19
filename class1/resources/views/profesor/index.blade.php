<table border="1">
    <tr><th>dni</th><th>Nombres</th><th>Apellidos</th></tr>
    @foreach($profesores as $profesor)
        <tr>
            <td>{{ $profesor->dni }}</td>
            <td>{{ $profesor->nombres }}</td>
            <td>{{ $profesor->apellidos }}</td>
        </tr>
    @endforeach
</table>