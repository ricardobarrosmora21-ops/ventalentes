@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="mb-6 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Perfil de Usuario</h1>

            <!-- Actualizar información -->
            <section class="bg-white shadow rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4">Información del perfil</h2>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="name" id="name" value="{{ $user->name }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                        <input type="email" name="email" id="email" value="{{ $user->email }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Guardar cambios
                    </button>
                </form>
            </section>

            <!-- Cambiar contraseña -->
            <section class="bg-white shadow rounded-lg p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4">Cambiar contraseña</h2>
                <form method="POST" action="{{ route('profile.password') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Contraseña
                            actual</label>
                        <input type="password" name="current_password" id="current_password"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Nueva contraseña</label>
                        <input type="password" name="password" id="password"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar
                            contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Actualizar contraseña
                    </button>
                </form>
            </section>

            <!-- Eliminar cuenta -->
            <section class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4 text-red-600">Eliminar cuenta</h2>
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <p class="mb-4 text-sm text-gray-600">Esta acción no se puede deshacer. Tu cuenta será eliminada
                        permanentemente.</p>

                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Eliminar cuenta
                    </button>
                </form>
            </section>
        </div>
    </div>
@endsection