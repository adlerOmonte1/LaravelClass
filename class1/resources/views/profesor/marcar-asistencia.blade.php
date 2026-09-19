<h1>Registrar cita: {{ $profesor->nombres }} {{ $profesor->apellidos }}</h1>

@if(session('mensaje'))
    <p>{{ session('mensaje') }}</p>
@endif

<form action="/profesores/{{ $profesor->id }}/cita" method="POST">
    @csrf
    <button type="submit">Registrar cita ahora</button>
</form>

<h2>Asistencias</h2>
<ul>
    @foreach($profesor->citas as $asistencia)
        <li>{{ $asistencia->fecha_cita }}</li>
    @endforeach
</ul>