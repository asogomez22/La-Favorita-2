<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // 1. Cambiar columna a enum con valor por defecto
        Schema::table('productos', function (Blueprint $table) {
            $table->enum('estado', ['novedad', 'normal'])->default('normal')->change();
        });

        // 2. Convertir valores existentes
        DB::table('productos')->whereNull('estado')->orWhere('estado', '')->update(['estado' => 'normal']);
        DB::table('productos')->where('estado', '!=', 'novedad')->where('estado', '!=', 'normal')->update(['estado' => 'normal']);
    }

    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->string('estado')->nullable()->change();
        });
    }
};