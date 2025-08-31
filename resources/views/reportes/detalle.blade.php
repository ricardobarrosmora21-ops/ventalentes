@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle Factura #{{ $factura->id }}</h1>
    <p>Cliente: {{ $factura->cliente_nombre }}</p>
    <p>Fecha: {{ $factura->fecha }}</p>
    <p>Total: ${{ number_format($factura->total, 2) }}</p>

    <h3>Detalles:</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($factura->detalles as $detalle)
            <tr>
                <td>{{ $detalle->presentacion->nombre ?? 'Producto' }}</td>
                <td>{{ $detalle->cantidad }}</td>
                <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                <td>${{ number_format($detalle->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('reportes.ventas') }}" class="btn btn-secondary mt-3">Volver a Reportes</a>
</div>
@endsection
