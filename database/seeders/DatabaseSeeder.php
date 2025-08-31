<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario admin solo si no existe
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now(),
                'remember_token' => \Str::random(10),
            ]
        );

        // Llamada a los demás seeders
        $this->call([
            CaracteristicaSeeder::class,
            CategoriaSeeder::class,
            MarcaSeeder::class,
                // PresentacionSeeder::class, 
            ProductoConPresentacionesSeeder::class,
        ]);

    }
}
