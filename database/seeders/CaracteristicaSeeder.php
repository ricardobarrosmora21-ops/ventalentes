<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Caracteristica;

class CaracteristicaSeeder extends Seeder
{
    public function run(): void
    {
        Caracteristica::create([
            'nombre' => 'Color',
            'descripcion' => 'Diferentes colores disponibles',
            'estado' => 1,
            'destacado' => 1,
        ]);

        Caracteristica::create([
            'nombre' => 'Tamaño',
            'descripcion' => 'Variaciones de tallas o tamaños',
            'estado' => 1,
            'destacado' => 0,
        ]);
    }
}
