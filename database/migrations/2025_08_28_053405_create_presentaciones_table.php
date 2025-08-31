<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('presentaciones', function (Blueprint $table) {
            $table->id();

            // Relaciones
            $table->foreignId('caracteristica_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('producto_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Datos principales
            $table->string('nombre', 60);
            $table->string('descripcion', 255)->nullable();
            $table->decimal('precio', 10, 2)->default(0);

            // Flags
            $table->boolean('estado')->default(1);
            $table->boolean('destacado')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presentaciones');
    }
};
