<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// ..._create_pedidos_table.php
// ..._create_pedido_producto_table.php
public function up()
{
    Schema::create('pedido_producto', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pedido_id')->constrained('pedidos')->cascadeOnDelete();
        $table->foreignId('producto_id')->constrained('productos')->cascadeOnDelete();
        $table->integer('cantidad');
        $table->decimal('precio_unitario', 8, 2); // Guardamos el precio del producto en el momento de la compra
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_producto');
    }
};
