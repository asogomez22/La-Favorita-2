<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('pedidos', function (Blueprint $table) {
$table->string('cliente_nombre')->default('Desconocido');
$table->string('cliente_email')->nullable();
$table->string('cliente_telefono')->default('000000000');
$table->string('cliente_direccion')->nullable();
$table->text('notas')->nullable();

    });
}

public function down()
{
    Schema::table('pedidos', function (Blueprint $table) {
        $table->dropColumn(['cliente_nombre','cliente_email','cliente_telefono','cliente_direccion','notas']);
    });
}

};
