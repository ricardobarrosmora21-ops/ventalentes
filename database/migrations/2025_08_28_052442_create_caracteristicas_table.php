<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crear tabla de características generales
     */
    public function up(): void
    {
        Schema::create('caracteristicas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 60); // Nombre de la característica
            $table->string('descripcion', 255)->nullable(); // Descripción opcional
            $table->boolean('estado')->default(1); // Estado activo/inactivo
            $table->boolean('destacado')->default(0); // Si está destacado o no
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Elimina la tabla características
     */
    public function down(): void
    {
        Schema::dropIfExists('caracteristicas');
    }
};
