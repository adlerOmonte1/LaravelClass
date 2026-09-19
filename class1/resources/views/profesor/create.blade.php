<form action="/profesores" method="POST">
    @csrf
    <input type="text" name="dni" placeholder="dni" maxlength="8">
    <input type="text" name="nombres" placeholder="Nombres">
    <input type="text" name="apellidos" placeholder="Apellidos">
    <button type="submit">Guardar</button>
</form>