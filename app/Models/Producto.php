<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'categoria_id',
        'marca_id',
        'imagen', // Aquí se guarda la imagen como base64 o ruta
    ];

    // Relación con Categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Relación con Marca
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    // Relación con Presentaciones
    public function presentaciones()
    {
        return $this->hasMany(Presentacion::class, 'producto_id');
    }

    // Evento para eliminar presentaciones relacionadas al borrar producto
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($producto) {
            $producto->presentaciones()->delete();

            // Eliminar imagen del storage si existe
            if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
                Storage::disk('public')->delete($producto->imagen);
            }
        });
    }

    /**
     * Accesor para mostrar la imagen directamente en base64 si está guardada como BLOB
     */
    public function getImagenBase64Attribute()
    {
        // Si la imagen es un path en storage
        if (Storage::disk('public')->exists($this->imagen)) {
            $path = Storage::disk('public')->path($this->imagen);
            $type = pathinfo($path, PATHINFO_EXTENSION);
            return 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($path));
        }

        // Si la imagen ya está guardada como BLOB en la base de datos
        return 'data:image/jpeg;base64,' . base64_encode($this->imagen);
    }
}
