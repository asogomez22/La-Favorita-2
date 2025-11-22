<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute; // <-- IMPORTANTE: Añadir esto

class Producto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'categoria_id',
        'activo',      // <-- AÑADIDO
        'destacado',   // <-- AÑADIDO
        'novedad', // <-- Añadir aquí
    ];

    /**
     * Define la relación "pertenece a" con Categoria.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Define la relación "pertenece a muchos" con Pedido.
     */
    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedido_producto')
                    ->withPivot('cantidad', 'precio_unitario')
                    ->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESORS & MUTATORS (para 'activo' y 'destacado')
    |--------------------------------------------------------------------------
    */

    /**
     * Mutador/Accesor para 'activo'.
     * Asegura que el valor sea siempre booleano.
     */
    protected function activo(): Attribute
    {
        return Attribute::make(
            // Convierte 'on', 1, 'true' a true, y null, 0, 'false' a false
            set: fn ($value) => filter_var($value, FILTER_VALIDATE_BOOLEAN),
        );
    }

    /**
     * Mutador/Accesor para 'destacado'.
     * Asegura que el valor sea siempre booleano.
     */
    protected function destacado(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => filter_var($value, FILTER_VALIDATE_BOOLEAN),
        );
    }
}