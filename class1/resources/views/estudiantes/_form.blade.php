<h2 class="h6 text-uppercase text-muted">Datos del estudiante</h2>
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <label for="codigo" class="form-label">Código</label>
        <input type="text" name="codigo" id="codigo" maxlength="10"
               class="form-control @error('codigo') is-invalid @enderror"
               value="{{ old('codigo', $estudiante->codigo) }}">
        @error('codigo') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4">
        <label for="dni" class="form-label">DNI</label>
        <input type="text" name="dni" id="dni" maxlength="8"
               class="form-control @error('dni') is-invalid @enderror"
               value="{{ old('dni', $estudiante->dni) }}">
        @error('dni') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4">
        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
               class="form-control @error('fecha_nacimiento') is-invalid @enderror"
               value="{{ old('fecha_nacimiento', $estudiante->fecha_nacimiento?->format('Y-m-d')) }}">
        @error('fecha_nacimiento') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label for="nombres" class="form-label">Nombres</label>
        <input type="text" name="nombres" id="nombres"
               class="form-control @error('nombres') is-invalid @enderror"
               value="{{ old('nombres', $estudiante->nombres) }}">
        @error('nombres') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label for="apellidos" class="form-label">Apellidos</label>
        <input type="text" name="apellidos" id="apellidos"
               class="form-control @error('apellidos') is-invalid @enderror"
               value="{{ old('apellidos', $estudiante->apellidos) }}">
        @error('apellidos') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-8">
        <label for="email" class="form-label">Correo</label>
        <input type="email" name="email" id="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $estudiante->email) }}">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label d-block">Modalidad</label>
        @foreach (['presencial' => 'Presencial', 'virtual' => 'Virtual'] as $valor => $texto)
            <div class="form-check form-check-inline">
                <input type="radio" name="modalidad" value="{{ $valor }}" id="modalidad_{{ $valor }}"
                       class="form-check-input" @checked(old('modalidad', $estudiante->modalidad) == $valor)>
                <label for="modalidad_{{ $valor }}" class="form-check-label">{{ $texto }}</label>
            </div>
        @endforeach
        @error('modalidad') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>
</div>

<h2 class="h6 text-uppercase text-muted">Perfil (1:1)</h2>
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <label for="celular" class="form-label">Celular (opcional)</label>
        <input type="text" name="celular" id="celular" maxlength="9"
               class="form-control @error('celular') is-invalid @enderror"
               value="{{ old('celular', $estudiante->perfil?->celular) }}">
        @error('celular') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-8">
        <label for="direccion" class="form-label">Dirección (opcional)</label>
        <input type="text" name="direccion" id="direccion"
               class="form-control @error('direccion') is-invalid @enderror"
               value="{{ old('direccion', $estudiante->perfil?->direccion) }}">
        @error('direccion') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-12">
        <label for="biografia" class="form-label">Biografía (opcional)</label>
        <textarea name="biografia" id="biografia" rows="2"
                  class="form-control @error('biografia') is-invalid @enderror">{{ old('biografia', $estudiante->perfil?->biografia) }}</textarea>
        @error('biografia') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<h2 class="h6 text-uppercase text-muted">Cursos (N:M)</h2>
<div class="row mb-3">
    @forelse ($cursos as $curso)
        <div class="col-md-6">
            <div class="form-check">
                <input type="checkbox" name="cursos[]" value="{{ $curso->id }}" id="curso_{{ $curso->id }}"
                       class="form-check-input" @checked(in_array($curso->id, old('cursos', $seleccionados)))>
                <label for="curso_{{ $curso->id }}" class="form-check-label">
                    {{ $curso->titulo }} <small class="text-muted">({{ $curso->codigo }})</small>
                </label>
            </div>
        </div>
    @empty
        <p class="text-muted">No hay cursos publicados.</p>
    @endforelse
    @error('cursos.*') <div class="text-danger small">{{ $message }}</div> @enderror
</div>
