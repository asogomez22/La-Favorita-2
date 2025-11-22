<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoProductoTable extends Migration
{
    public function up()
    {
        // Evitamos crear la tabla si ya existe
        if (!Schema::hasTable('pedido_producto')) {
            Schema::create('pedido_producto', function (Blueprint $table) {
                $table->foreignId('pedido_id')->constrained()->onDelete('cascade');
                $table->foreignId('producto_id')->constrained()->onDelete('cascade');
                $table->integer('cantidad')->default(1);
                $table->decimal('precio_unitario', 8, 2);
                $table->primary(['pedido_id', 'producto_id']);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('pedido_producto');
    }
}
