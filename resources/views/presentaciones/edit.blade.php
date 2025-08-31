<!-- resources/views/presentaciones/edit.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Presentación</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">
    <h2 class="text-2xl font-bold text-blue-700 mb-6">Editar Presentación</h2>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('presentaciones.update', $presentacion) }}" class="bg-white p-6 rounded shadow max-w-xl mx-auto">
        @csrf
        @method('PUT')
        <input type="text" name="nombre" value="{{ old('nombre', $presentacion->nombre) }}" class="w-full mb-4 p-2 border rounded" required>
        <textarea name="descripcion" rows="3" class="w-full mb-4 p-2 border rounded">{{ old('descripcion', $presentacion->descripcion) }}</textarea>
        <input type="number" name="precio" step="0.01" min="0" value="{{ old('precio', $presentacion->precio) }}" class="w-full mb-4 p-2 border rounded" required>
        <select name="caracteristica_id" class="w-full mb-4 p-2 border rounded" required>
            @foreach($caracteristicas as $caracteristica)
                <option value="{{ $caracteristica->id }}" {{ $presentacion->caracteristica_id == $caracteristica->id ? 'selected' : '' }}>
                    {{ $caracteristica->nombre }}
                </option>
            @endforeach
        </select>
        <div class="flex justify-end">
            <a href="{{ route('presentaciones.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded mr-2">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Actualizar</button>
        </div>
    </form>
</body>
</html>
