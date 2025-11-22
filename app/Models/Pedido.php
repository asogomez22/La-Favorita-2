<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PedidoProducto; // <-- PAS 1: Importem el nou model

class Pedido extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cliente_nombre',
        'cliente_email',
        'cliente_telefono',
        'precio_total',
        'estado',
        'notas',
        'stripe_session_id',
        'stripe_payment_intent_id',
    ];

    /**
     * Define la relación muchos a muchos con Producto.
     */
    public function productos()
    {
        // Le decimos a Eloquent que use un modelo Pivot personalizado
        // ('PedidoProducto') donde hemos definido que no hay timestamps.
        
        return $this->belongsToMany(Producto::class, 'pedido_producto')
                    ->using(PedidoProducto::class) // <-- PAS 2: Aquesta és la solució correcta
                    ->withPivot('cantidad', 'precio_unitario');
    }
}

