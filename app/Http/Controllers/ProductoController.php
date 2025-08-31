<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with(['categoria', 'marca', 'presentaciones'])->paginate(10);
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        return view('productos.create', compact('categorias', 'marcas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'presentaciones' => 'nullable|array',
            'presentaciones.*.nombre' => 'required|string|max:255',
            'presentaciones.*.precio' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $producto = Producto::create($request->only([
                'nombre',
                'descripcion',
                'precio',
                'stock',
                'categoria_id',
                'marca_id'
            ]));

            // Guardar imagen
            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen')->store('productos', 'public');
                $producto->update(['imagen' => $imagen]);
            }

            // Guardar presentaciones
            if ($request->filled('presentaciones')) {
                foreach ($request->presentaciones as $data) {
                    $producto->presentaciones()->create([
                        'nombre' => $data['nombre'],
                        'precio' => $data['precio'],
                        'caracteristica_id' => 1,
                        'estado' => true,
                        'destacado' => false,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al crear el producto: ' . $e->getMessage()]);
        }
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $producto->load('presentaciones');
        return view('productos.edit', compact('producto', 'categorias', 'marcas'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'marca_id' => 'required|exists:marcas,id',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'presentaciones' => 'nullable|array',
            'presentaciones.*.nombre' => 'required|string|max:255',
            'presentaciones.*.precio' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Actualizar datos principales
            $producto->update($request->only([
                'nombre',
                'descripcion',
                'precio',
                'stock',
                'categoria_id',
                'marca_id'
            ]));

            // Reemplazar imagen
            if ($request->hasFile('imagen')) {
                if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
                    Storage::disk('public')->delete($producto->imagen);
                }
                $path = $request->file('imagen')->store('productos', 'public');
                $producto->update(['imagen' => $path]);
            }

            // Actualizar presentaciones
            $presentacionesIds = [];
            if ($request->has('presentaciones')) {
                foreach ($request->presentaciones as $presentacionData) {
                    if (isset($presentacionData['id'])) {
                        // Editar existente
                        $presentacion = $producto->presentaciones()->find($presentacionData['id']);
                        if ($presentacion) {
                            $presentacion->update([
                                'nombre' => $presentacionData['nombre'],
                                'precio' => $presentacionData['precio'],
                            ]);
                            $presentacionesIds[] = $presentacion->id;
                        }
                    } else {
                        // Crear nueva
                        $new = $producto->presentaciones()->create([
                            'nombre' => $presentacionData['nombre'],
                            'precio' => $presentacionData['precio'],
                            'caracteristica_id' => 1,
                            'estado' => true,
                            'destacado' => false,
                        ]);
                        $presentacionesIds[] = $new->id;
                    }
                }
            }

            // Eliminar las que no están en la petición
            $producto->presentaciones()->whereNotIn('id', $presentacionesIds)->delete();

            DB::commit();
            return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al actualizar el producto: ' . $e->getMessage()]);
        }
    }

    public function destroy(Producto $producto)
    {
        try {
            if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
                Storage::disk('public')->delete($producto->imagen);
            }

            $producto->presentaciones()->delete();
            $producto->delete();

            return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al eliminar el producto: ' . $e->getMessage()]);
        }
    }

    public function show(Producto $producto)
    {
        $producto->load(['categoria', 'marca', 'presentaciones']);
        return view('productos.show', compact('producto'));
    }

    /**
     * Catálogo público
     * Devuelve todos los productos para mostrar en welcome.blade.php
     */
    public function catalogo()
    {
        $productos = Producto::all(); // Trae todos los productos
        return view('welcome', compact('productos'));
    }

    /**
     * Servir imagen de producto directamente desde storage
     */
    public function imagenUrl(Producto $producto)
    {
        $path = storage_path('app/public/' . $producto->imagen);

        if ($producto->imagen && file_exists($path)) {
            return response()->file($path);
        }

        // Imagen por defecto si no existe
        return response()->file(public_path('img/default.png'));
    }
}
