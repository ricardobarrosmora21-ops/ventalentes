<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Marca;
use App\Models\Caracteristica;

class MarcaSeeder extends Seeder
{
    public function run(): void
    {
        $caracteristica = Caracteristica::first();

        if ($caracteristica) {
            Marca::create([
                'caracteristica_id' => $caracteristica->id,
                'nombre' => 'Ray-Ban',
                'descripcion' => 'Marca reconocida de gafas de sol',
                'estado' => 1,
            ]);

            Marca::create([
                'caracteristica_id' => $caracteristica->id,
                'nombre' => 'Oakley',
                'descripcion' => 'Marca deportiva de gafas',
                'estado' => 1,
            ]);
        }
    }
}
