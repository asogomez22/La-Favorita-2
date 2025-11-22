<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up() {
        // Comprobar si la columna ya existe
        if (!Schema::hasColumn('productos', 'precio')) {
            Schema::table('productos', function (Blueprint $table) {
                $table->decimal('precio', 8, 2)->after('descripcion');
            });
        }
    }

    public function down() {
        if (Schema::hasColumn('productos', 'precio')) {
            Schema::table('productos', function (Blueprint $table) {
                $table->dropColumn('precio');
            });
        }
    }
};
