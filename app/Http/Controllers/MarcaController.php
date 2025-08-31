<?php
namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Caracteristica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::orderBy('id', 'asc')->get(); // ✅ orden por ID de creación
        return view('marcas.index', compact('marcas'));
    }

    public function create()
    {
        $caracteristicas = Caracteristica::all();
        return view('marcas.create', compact('caracteristicas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'destacado' => 'nullable|boolean',
        ]);

        try {
            DB::beginTransaction();

            // Buscar o crear característica
            $caracteristica = Caracteristica::firstOrCreate(
                ['nombre' => $request->input('nombre')],
                [
                    'descripcion' => $request->input('descripcion'),
                    'destacado' => $request->has('destacado') ? 1 : 0,
                ]
            );

            // Crear la marca
            $marca = Marca::create([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'caracteristica_id' => $caracteristica->id,
                'estado' => 1,
                'destacado' => $request->has('destacado') ? 1 : 0,
            ]);

            DB::commit();

            return redirect()->route('marcas.index')->with('success', 'Marca creada correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Error al registrar la marca: ' . $e->getMessage()]);
        }
    }

    public function show(Marca $marca)
    {
        $marca->load('caracteristica');
        return view('marcas.show', compact('marca'));
    }

    public function edit(Marca $marca)
    {
        $caracteristicas = Caracteristica::all();
        return view('marcas.edit', compact('marca', 'caracteristicas'));
    }


    public function update(Request $request, Marca $marca)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'caracteristica_id' => 'required|exists:caracteristicas,id',
        ]);

        try {
            DB::beginTransaction();

            $marca->update([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'caracteristica_id' => $request->input('caracteristica_id'),
            ]);

            DB::commit();

            return redirect()->route('marcas.index')->with('success', 'Marca actualizada correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Error al actualizar la marca: ' . $e->getMessage()]);
        }
    }

    public function destroy(Marca $marca)
    {
        try {
            $marca->delete();
            return redirect()->route('marcas.index')->with('success', 'Marca eliminada correctamente.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error al eliminar la marca: ' . $e->getMessage()]);
        }
    }
}
