<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            // Se mostrará en la web por defecto (true)
            $table->boolean('activo')->default(true)->after('precio');
            
            // No será destacado por defecto (false)
            $table->boolean('destacado')->default(false)->after('activo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            // Esto es para poder deshacer la migración
            $table->dropColumn(['activo', 'destacado']);
        });
    }
};
