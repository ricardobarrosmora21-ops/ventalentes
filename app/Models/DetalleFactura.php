<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;

    protected $table = 'detalles_factura';

    protected $fillable = [
        'factura_id',
        'presentacion_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    // Relación con Factura
    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }

    // Relación con Presentacion
    public function presentacion()
    {
        return $this->belongsTo(Presentacion::class);
    }
}
