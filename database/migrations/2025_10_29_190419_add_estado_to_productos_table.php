<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/..._add_estado_to_productos_table.php
public function up()
{
    Schema::table('productos', function (Blueprint $table) {
        $table->enum('estado', ['novedad', 'normal'])
              ->default('normal')
              ->after('destacado');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            //
        });
    }
};
