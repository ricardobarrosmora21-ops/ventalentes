<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura #{{ $factura->numero }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        h2 { margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Factura #{{ $factura->numero }}</h2>
    <p><strong>Cliente:</strong> {{ $factura->cliente->nombre }}</p>
    <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</p>
    <p><strong>Total:</strong> ${{ number_format($factura->total, 2) }}</p>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Presentación</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($factura->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->presentacion->producto->nombre ?? '—' }}</td>
                    <td>{{ $detalle->presentacion->nombre ?? '—' }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                    <td>${{ number_format($detalle->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
