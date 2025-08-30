<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crear tabla de usuarios y manejo de autenticación
     */
    public function up(): void
    {
        // Tabla usuarios
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del usuario
            $table->string('email')->unique(); // Email único
            $table->string('img')->nullable(); // Imagen de perfil
            $table->boolean('estado')->default(1); // Estado activo/inactivo
            $table->timestamp('email_verified_at')->nullable(); // Verificación email
            $table->string('password'); // Contraseña
            $table->rememberToken(); // Token "remember me"
            $table->timestamps();
        });

        // Tokens de recuperación de contraseña
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Sesiones activas de usuarios
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     * Elimina tablas de usuarios y autenticación
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
