<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('pedidos', function (Blueprint $table) {
        if (Schema::hasColumn('pedidos', 'cliente_email')) {
            $table->string('cliente_email')->nullable()->change();
        }
        if (Schema::hasColumn('pedidos', 'cliente_direccion')) {
            $table->string('cliente_direccion')->nullable()->change();
        }
    });
}

    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->string('cliente_email')->nullable(false)->change();
            $table->string('cliente_direccion')->nullable(false)->change();
        });
    }
};