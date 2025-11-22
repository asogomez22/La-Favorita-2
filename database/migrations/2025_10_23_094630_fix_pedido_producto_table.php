<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixPedidoProductoTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pedido_producto', function (Blueprint $table) {
            // Si existe la columna incorrecta, la eliminamos
            if (Schema::hasColumn('pedido_producto', 'precio_unitario')) {
                $table->dropColumn('precio_unitario');
            }

            // Añadimos la columna correcta
            if (!Schema::hasColumn('pedido_producto', 'precio')) {
                $table->decimal('precio', 8, 2)->after('cantidad');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedido_producto', function (Blueprint $table) {
            $table->dropColumn('precio');
            $table->decimal('precio_unitario', 8, 2)->after('cantidad');
        });
    }
}
