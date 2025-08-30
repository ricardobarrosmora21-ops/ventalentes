<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Presentacion;
use App\Models\Caracteristica;

class PresentacionSeeder extends Seeder
{
    public function run(): void
    {
        // Obtén una característica para enlazar
        $caracteristica = Caracteristica::first();

        Presentacion::create([
            'caracteristica_id' => $caracteristica->id,
            'nombre' => 'Caja de 12 unidades',
            'descripcion' => 'Presentación estándar',
            'estado' => 1,
            'destacado' => 0,
        ]);

        Presentacion::create([
            'caracteristica_id' => $caracteristica->id,
            'nombre' => 'Botella 500ml',
            'descripcion' => 'Presentación individual',
            'estado' => 1,
            'destacado' => 1,
        ]);
    }
}
