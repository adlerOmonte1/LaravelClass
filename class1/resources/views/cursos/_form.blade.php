<div class="row g-3">
    <div class="col-md-6">
        <label for="categoria_id" class="form-label">Categoría</label>
        <select name="categoria_id" id="categoria_id" class="form-select @error('categoria_id') is-invalid @enderror">
            <option value="">-- Seleccione --</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}"
                    @selected(old('categoria_id', $curso->categoria_id ?? request('categoria_id')) == $categoria->id)>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>
        @error('categoria_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-2">
        <label for="codigo" class="form-label">Código</label>
        <input type="text" name="codigo" id="codigo" maxlength="10"
               class="form-control @error('codigo') is-invalid @enderror"
               value="{{ old('codigo', $curso->codigo) }}">
        @error('codigo') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label for="nivel" class="form-label">Nivel</label>
        <select name="nivel" id="nivel" class="form-select @error('nivel') is-invalid @enderror">
            <option value="">-- Seleccione --</option>
            @foreach (App\Models\Curso::NIVELES as $nivel)
                <option value="{{ $nivel }}" @selected(old('nivel', $curso->nivel) == $nivel)>{{ $nivel }}</option>
            @endforeach
        </select>
        @error('nivel') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror"
               value="{{ old('titulo', $curso->titulo) }}">
        @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea name="descripcion" id="descripcion" rows="3"
                  class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $curso->descripcion) }}</textarea>
        @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3">
        <label for="creditos" class="form-label">Créditos</label>
        <input type="number" name="creditos" id="creditos" min="1" max="6"
               class="form-control @error('creditos') is-invalid @enderror"
               value="{{ old('creditos', $curso->creditos) }}">
        @error('creditos') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3">
        <label for="cupos" class="form-label">Cupos</label>
        <input type="number" name="cupos" id="cupos" min="1" max="60"
               class="form-control @error('cupos') is-invalid @enderror"
               value="{{ old('cupos', $curso->cupos) }}">
        @error('cupos') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3">
        <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio"
               class="form-control @error('fecha_inicio') is-invalid @enderror"
               value="{{ old('fecha_inicio', $curso->fecha_inicio?->format('Y-m-d')) }}">
        @error('fecha_inicio') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3 d-flex align-items-end">
        <div class="form-check mb-2">
            <input type="hidden" name="publicado" value="0">   {{-- se envía si NO marcas --}}
            <input type="checkbox" name="publicado" value="1" id="publicado" class="form-check-input"
                   @checked(old('publicado', $curso->publicado))>
            <label for="publicado" class="form-check-label">Publicado</label>
        </div>
    </div>
</div>
