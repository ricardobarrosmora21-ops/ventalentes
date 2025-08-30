<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario admin de prueba
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678'),
        ]);

        // Llamada a los demás seeders
        $this->call([
            CaracteristicaSeeder::class,
            CategoriaSeeder::class,
            MarcaSeeder::class,
            PresentacionSeeder::class,
        ]);
    }
}
