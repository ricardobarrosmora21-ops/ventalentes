<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'caracteristica_id',
        'nombre',
        'descripcion',
    ];

    // Relaciones
    public function caracteristica()
    {
        return $this->belongsTo(Caracteristica::class);
    }
}
