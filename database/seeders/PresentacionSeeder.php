<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;
use App\Models\Presentacion;
use App\Models\Caracteristica;

class PresentacionSeeder extends Seeder
{
    use App\Models\Producto;
    use App\Models\Presentacion;

    public function run()
    {
        $producto = Producto::firstOrCreate([
            'nombre' => 'Producto genérico',
            'precio' => 100,
            'stock' => 10,
            'categoria_id' => 1,
            'marca_id' => 1,
        ]);

        Presentacion::create([
            'caracteristica_id' => 1,
            'producto_id' => $producto->id,
            'nombre' => 'Caja de 12 unidades',
            'descripcion' => 'Presentación estándar',
            'precio' => 100,
            'estado' => true,
            'destacado' => false,
        ]);
    }

}
