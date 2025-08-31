<?php

namespace App\Http\Controllers;

use App\Models\Presentacion;
use App\Models\Caracteristica;
use Illuminate\Http\Request;

class PresentacionController extends Controller
{
    public function index()
    {
        $presentaciones = Presentacion::with('caracteristica')->paginate(10);
        return view('presentaciones.index', compact('presentaciones'));
    }

    public function create()
    {
        $caracteristicas = Caracteristica::all();
        return view('presentaciones.create', compact('caracteristicas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'caracteristica_id' => 'required|exists:caracteristicas,id',
        ]);

        Presentacion::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'precio' => $request->input('precio'),
            'caracteristica_id' => $request->input('caracteristica_id'),
            'estado' => 1,
            'destacado' => 0,
        ]);

        return redirect()->route('presentaciones.index')->with('success', 'Presentación creada correctamente.');
    }

    public function edit(Presentacion $presentacion)
    {
        $caracteristicas = Caracteristica::all();
        return view('presentaciones.edit', compact('presentacion', 'caracteristicas'));
    }

    public function update(Request $request, Presentacion $presentacion)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'caracteristica_id' => 'required|exists:caracteristicas,id',
        ]);

        $presentacion->update([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'precio' => $request->input('precio'),
            'caracteristica_id' => $request->input('caracteristica_id'),
        ]);

        return redirect()->route('presentaciones.index')->with('success', 'Presentación actualizada correctamente.');
    }

    public function destroy(Presentacion $presentacion)
    {
        $presentacion->delete();
        return redirect()->route('presentaciones.index')->with('success', 'Presentación eliminada correctamente.');
    }
}
