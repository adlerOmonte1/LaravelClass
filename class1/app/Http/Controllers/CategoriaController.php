<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $categorias = Categoria::withCount('cursos')                 // crea cursos_count
            ->when($request->filled('buscar'), fn ($q) => $q->where('nombre', 'like', '%' . $request->buscar . '%'))
            ->orderBy('nombre')
            ->get();

        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create', ['categoria' => new Categoria]);
    }

    public function store(Request $request)
    {
        $datos = $request->validate($this->reglas(), $this->mensajes());
        $categoria = Categoria::create($datos);

        return redirect()->route('categorias.show', $categoria)
                         ->with('success', 'Categoría registrada correctamente.');
    }

    public function show(Categoria $categoria)
    {
        $cursos = $categoria->cursos()->withCount('estudiantes')->orderBy('titulo')->get();

        return view('categorias.show', compact('categoria', 'cursos'));
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $datos = $request->validate($this->reglas($categoria->id), $this->mensajes());
        $categoria->update($datos);

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada.');
    }

    public function destroy(Categoria $categoria)
    {
        if ($categoria->cursos()->exists()) {
            return back()->with('error', "No se puede eliminar \"{$categoria->nombre}\": tiene cursos asociados.");
        }

        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada.');
    }

    // Reglas compartidas; en update ignora su propio nombre en el unique
    private function reglas(?int $ignorarId = null): array
    {
        return [
            'nombre'      => ['required', 'string', 'max:80', Rule::unique('categorias', 'nombre')->ignore($ignorarId)],
            'descripcion' => ['nullable', 'string', 'max:255'],
        ];
    }

    private function mensajes(): array
    {
        return [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.unique'   => 'Ya existe una categoría con ese nombre.',
            'nombre.max'      => 'El nombre no debe superar 80 caracteres.',
        ];
    }
}
