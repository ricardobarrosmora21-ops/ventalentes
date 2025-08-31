<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'direccion', // ← este campo es obligatorio para que se guarde
    ];

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }
}
