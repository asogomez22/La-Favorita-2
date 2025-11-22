<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClienteEmailToPedidosTable extends Migration
{
    public function up()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // Solo agregar si no existe
            if (!Schema::hasColumn('pedidos', 'cliente_email')) {
                $table->string('cliente_email')->after('cliente_nombre');
            }
        });
    }

    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            if (Schema::hasColumn('pedidos', 'cliente_email')) {
                $table->dropColumn('cliente_email');
            }
        });
    }
}
