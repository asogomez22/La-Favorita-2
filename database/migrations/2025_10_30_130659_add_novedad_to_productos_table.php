<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            // Añadimos la columna 'novedad' que será booleana,
            // puede ser nula (o default false) y tendrá un índice.
            $table->boolean('novedad')->default(false)->after('destacado');
            // Opcional: Si SÓLO puede haber UNA novedad, un índice único
            // para valores TRUE es más complejo. Lo manejaremos por código.
        });
    }

    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn('novedad');
        });
    }
};