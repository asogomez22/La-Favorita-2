<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Este es un modelo Pivot personalizado para la tabla 'pedido_producto'.
 * Su única función es decirle a Eloquent que esta tabla
 * NO tiene las columnas 'created_at' y 'updated_at'.
 */
class PedidoProducto extends Pivot
{
    /**
     * Indica si el modelo debe tener timestamps.
     *
     * @var bool
     */
    public $timestamps = false;
}

