<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $table = 'marcas';
    protected $fillable = [
        'nombre',
        'descripcion',
        'caracteristica_id',
        'estado',
        'destacado',
    ];

    public function caracteristica()
    {
        return $this->belongsTo(Caracteristica::class);
    }
}
