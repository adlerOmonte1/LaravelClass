@extends("layout.app")

@section("contenido")
<table class = "table">
    <tr>
        <th>curso</th>
        <th>creditos</th>
        <th>horas</th>
        <th>codigo</th>
        <th>prerequisito</th>
        <th>ciclo</th>
        <th></th>
    </tr>
    
    @foreach($cursos as $curso)
    <tr>
        <td>{{$curso->nombre}}</td>
        <td>{{$curso->creditos}}</td>
        <td>{{$curso->horas}}</td>
        <td>{{$curso->codigo}}</td>
        <td>{{$curso->prerequisito}}</td>
        <td>{{$curso->ciclo}}</td>
        <td><a href="/cursos/{{$curso->id}}/edit">modificar</a></td>
    </tr>
    @endforeach
</table>
@endsection