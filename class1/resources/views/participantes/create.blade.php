<h1>Inscripción al Taller de Desarrollo Web con Laravel</h1>

@if (session('success'))
    <div class="ok">{{ session('success') }}</div>
@endif

{{-- Resumen de errores --}}
@if ($errors->any())
    <div class="resumen">
        <strong>Corrige los siguientes errores:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('participantes.store') }}" method="POST">
    @csrf

    <div class="campo">
        <label>Nombres</label><br>
        <input type="text" name="nombres" value="{{ old('nombres') }}">
        @error('nombres') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="campo">
        <label>Apellidos</label><br>
        <input type="text" name="apellidos" value="{{ old('apellidos') }}">
        @error('apellidos') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="campo">
        <label>DNI</label><br>
        <input type="text" name="dni" maxlength="8" value="{{ old('dni') }}">
        @error('dni') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="campo">
        <label>Correo</label><br>
        <input type="email" name="correo" value="{{ old('correo') }}">
        @error('correo') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="campo">
        <label>Celular (opcional)</label><br>
        <input type="text" name="celular" maxlength="9" value="{{ old('celular') }}">
        @error('celular') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="campo">
        <label>Fecha de nacimiento</label><br>
        <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
        @error('fecha_nacimiento') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="campo">
        <label>Modalidad</label><br>
        <label><input type="radio" name="modalidad" value="presencial" @checked(old('modalidad') === 'presencial')> Presencial</label>
        <label><input type="radio" name="modalidad" value="virtual" @checked(old('modalidad') === 'virtual')> Virtual</label>
        @error('modalidad') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="campo">
        <label><input type="checkbox" name="es_estudiante" value="1" @checked(old('es_estudiante'))> Soy estudiante</label>
    </div>

    <div class="campo">
        <label>Código de estudiante</label><br>
        <input type="text" name="codigo_estudiante" maxlength="9" value="{{ old('codigo_estudiante') }}">
        @error('codigo_estudiante') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="campo">
        <label>Ciclo</label><br>
        <input type="number" name="ciclo" min="1" max="10" value="{{ old('ciclo') }}">
        @error('ciclo') <div class="error">{{ $message }}</div> @enderror
    </div>

    <div class="campo">
        <label><input type="checkbox" name="acepta_terminos" value="1" @checked(old('acepta_terminos'))> Acepto los términos y condiciones</label>
        @error('acepta_terminos') <div class="error">{{ $message }}</div> @enderror
    </div>

    <button type="submit">Inscribirme</button>
</form>