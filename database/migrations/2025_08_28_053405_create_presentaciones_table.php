<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('presentaciones', function (Blueprint $table) {
            $table->id();

            // Relación con características
            $table->foreignId('caracteristica_id')
                  ->constrained('caracteristicas')
                  ->onDelete('cascade');

            // Campos principales de la tabla
            $table->string('nombre', 60);
            $table->string('descripcion', 255)->nullable();
            $table->boolean('estado')->default(1);    // Activo = 1, Inactivo = 0
            $table->boolean('destacado')->default(0); // Destacado = 1, No = 0

            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presentaciones');
    }
};
