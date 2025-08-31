<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Presentacion;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Caracteristica;

class ProductoConPresentacionesSeeder extends Seeder
{
    public function run()
    {
        // Crear característica si no existe
        $caracteristica = Caracteristica::firstOrCreate(['nombre' => 'Estándar']);

        // Crear categoría si no existe
        $categoria = Categoria::firstOrCreate(['nombre' => 'General']);

        // Crear marca asociada a la característica
        $marca = Marca::firstOrCreate([
            'nombre' => 'Genérica',
            'caracteristica_id' => $caracteristica->id,
        ]);

        // Productos de prueba
        $productos = [
            ['nombre' => 'Gafas de sol', 'precio' => 200, 'stock' => 10],
            ['nombre' => 'Zapatos deportivos', 'precio' => 250, 'stock' => 15],
            ['nombre' => 'Lentes ópticos', 'precio' => 180, 'stock' => 8],
        ];

        foreach ($productos as $data) {
            $producto = Producto::create([
                'nombre'       => $data['nombre'],
                'precio'       => $data['precio'],
                'stock'        => $data['stock'],
                'categoria_id' => $categoria->id,
                'marca_id'     => $marca->id,
            ]);

            // Presentaciones asociadas
            Presentacion::create([
                'producto_id'      => $producto->id,
                'caracteristica_id'=> $caracteristica->id,
                'nombre'           => 'Caja x 10',
                'descripcion'      => 'Presentación estándar',
                'precio'           => $producto->precio,
                'estado'           => true,
                'destacado'        => false,
            ]);

            Presentacion::create([
                'producto_id'      => $producto->id,
                'caracteristica_id'=> $caracteristica->id,
                'nombre'           => 'Unidad',
                'descripcion'      => 'Venta individual',
                'precio'           => $producto->precio * 0.9,
                'estado'           => true,
                'destacado'        => false,
            ]);
        }
    }
}
