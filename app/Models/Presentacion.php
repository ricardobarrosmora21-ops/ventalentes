<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
    protected $table = 'presentaciones';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'caracteristica_id',
        'producto_id', // ← asegúrate de tener este campo en la tabla
        'estado',
        'destacado',
    ];

    public function caracteristica()
    {
        return $this->belongsTo(Caracteristica::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

}
