<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::table('pedidos', function (Blueprint $table) {
        // Afegim la columna que falta
        // La posem 'decimal' per guardar diners (ex: 10.50)
        // La poso després de 'cliente_telefono' per ordre
        $table->decimal('precio_total', 10, 2)->default(0)->after('cliente_telefono');
    });
}

    /**
     * Reverse the migrations.
     */
public function down(): void
{
    Schema::table('pedidos', function (Blueprint $table) {
        $table->dropColumn('precio_total');
    });
}
};
