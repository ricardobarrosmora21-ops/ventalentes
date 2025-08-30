<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Caracteristica;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $caracteristica = Caracteristica::first();

        if ($caracteristica) {
            Categoria::create([
                'caracteristica_id' => $caracteristica->id,
                'nombre' => 'Gafas de Sol',
                'descripcion' => 'Lentes oscuros para protección solar',
                'estado' => 1,
                'destacado' => 1,
            ]);
        }
    }
}
