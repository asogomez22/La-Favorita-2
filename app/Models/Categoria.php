<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // Se ha eliminado 'precio' de $fillable
    protected $fillable = ['nombre'];

    /**
     * Una Categoría tiene muchos Productos.
     */
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
