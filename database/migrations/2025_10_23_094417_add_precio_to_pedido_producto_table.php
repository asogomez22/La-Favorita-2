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
    Schema::table('pedido_producto', function (Blueprint $table) {
        $table->decimal('precio', 8, 2)->after('cantidad');
    });
}

public function down(): void
{
    Schema::table('pedido_producto', function (Blueprint $table) {
        $table->dropColumn('precio');
    });
}

};
