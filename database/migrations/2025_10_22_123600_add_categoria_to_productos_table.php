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
        Schema::table('productos', function (Blueprint $table) {
            // Añadimos la columna solo si no existe
            if (!Schema::hasColumn('productos', 'categoria_id')) {
                $table->foreignId('categoria_id')
                    ->nullable() // SQLite no soporta constraints en columnas existentes, mejor nullable
                    ->constrained('categorias')
                    ->cascadeOnDelete();
            }

            // Para SQLite no podemos usar removeColumn directamente
            if (Schema::getConnection()->getDriverName() !== 'sqlite') {
                if (Schema::hasColumn('productos', 'precio')) {
                    $table->dropColumn('precio');
                }
            }
        });
    }

    /**
     * Revertir los cambios.
     */
    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            if (Schema::hasColumn('productos', 'categoria_id')) {
                $table->dropForeign(['categoria_id']);
                $table->dropColumn('categoria_id');
            }

            if (!Schema::hasColumn('productos', 'precio')) {
                $table->decimal('precio', 8, 2)->default(0);
            }
        });
    }
};
