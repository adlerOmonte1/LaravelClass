@extends("layout.app")

@section("contenido")
<form method="post" action="{{route('curso.store)'}}">
    @csrf
    <input class="form-control" type="text" name="nombre" placeholder="Ingrese nombre"/><br>
    <input class="form-control" type="number" name="creditos" placeholder="Ingrese creditos"/><br>
    <input class="form-control" type="number" name="horas" placeholder="Ingrese horas"/><br>
    <input class="form-control" type="text" name="codigo" placeholder="Ingrese codigo"/><br>
    <input class="form-control" type="text" name="prerequisito" placeholder="Ingrese prerequisito"/><br>
    <input class="form-control" type="text" name="ciclo" placeholder="Ingrese ciclo"/><br>
    <input class="btn" type="submit" value="Guardar"/>
</form>
@endsection