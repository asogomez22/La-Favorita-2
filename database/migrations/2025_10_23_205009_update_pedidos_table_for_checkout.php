<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            // user_id puede ser null (para pedidos de invitados)
            $table->foreignId('user_id')->nullable()->change();

            // Añadir columnas si no existen
            if (!Schema::hasColumn('pedidos', 'cliente_nombre')) {
                $table->string('cliente_nombre')->after('id');
            }

            if (!Schema::hasColumn('pedidos', 'cliente_telefono')) {
                $table->string('cliente_telefono')->after('cliente_nombre');
            }

            if (!Schema::hasColumn('pedidos', 'notas')) {
                $table->text('notas')->nullable()->after('estado');
            }

            // Renombrar 'total' → 'precio_total' (solo si existe)
            if (Schema::hasColumn('pedidos', 'total') && !Schema::hasColumn('pedidos', 'precio_total')) {
                $table->renameColumn('total', 'precio_total');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable(false)->change();
            if (Schema::hasColumn('pedidos', 'cliente_nombre')) $table->dropColumn('cliente_nombre');
            if (Schema::hasColumn('pedidos', 'cliente_telefono')) $table->dropColumn('cliente_telefono');
            if (Schema::hasColumn('pedidos', 'notas')) $table->dropColumn('notas');
            if (Schema::hasColumn('pedidos', 'precio_total') && !Schema::hasColumn('pedidos', 'total')) {
                $table->renameColumn('precio_total', 'total');
            }
        });
    }
};
