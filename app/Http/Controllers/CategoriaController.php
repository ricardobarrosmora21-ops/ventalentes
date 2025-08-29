<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Mostrar listado de categorías.
     */
    public function index()
    {
        $categorias = Categoria::latest()->paginate(10);
        return view('categoria.index', compact('categorias'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Guardar una categoría nueva en la BD.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
            'descripcion' => 'nullable|string|max:500',
        ]);

        Categoria::create($request->all());

        return redirect()->route('categorias.index')
                         ->with('success', 'Categoría creada correctamente.');
    }

    /**
     * Mostrar una categoría específica.
     */
    public function show(Categoria $categoria)
    {
        return view('categoria.show', compact('categoria'));
    }

    /**
     * Mostrar formulario para editar.
     */
    public function edit(Categoria $categoria)
    {
        return view('categoria.edit', compact('categoria'));
    }

    /**
     * Actualizar una categoría en la BD.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $categoria->id,
            'descripcion' => 'nullable|string|max:500',
        ]);

        $categoria->update($request->all());

        return redirect()->route('categorias.index')
                         ->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Eliminar categoría.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')
                         ->with('success', 'Categoría eliminada correctamente.');
    }
}
