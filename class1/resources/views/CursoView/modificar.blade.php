@extends("layout.app")

@section("contenido")
<h1>Modificar Curso</h1>
<form method="post" action="/cursos/{{$id}}">
    @foreach($curso as $item)
    <input type="text" name="nombre" value="{{$item->nombre}}"  placeholder="Ingrese nombre"/><br>
    <input type="number" name="creditos" value="{{$item->creditos}}" placeholder="Ingrese creditos"/><br>
    <input type="number" name="horas" value="{{$item->horas}}" placeholder="Ingrese horas"/><br>
    <input type="text" name="codigo" value="{{$item->codigo}}" placeholder="Ingrese codigo"/><br>
    <input type="text" name="prerequisito" value="{{$item->prerequisito}}" placeholder="Ingrese prerequisito"/><br>
    <input type="text" name="ciclo" value="{{$item->ciclo}}" placeholder="Ingrese ciclo"/><br>
    <input type="submit" value="Actualizar"/>
    @endforeach()
    @method('PUT')
</form>
@endsection