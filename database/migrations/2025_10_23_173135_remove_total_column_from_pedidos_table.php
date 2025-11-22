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
            // Comprobar si la columna 'total' existe antes de intentar borrarla
            if (Schema::hasColumn('pedidos', 'total')) {
                Schema::table('pedidos', function (Blueprint $table) {
                    $table->dropColumn('total');
                });
            }
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            // Si deshacemos, volvemos a añadir la columna (por si acaso)
             Schema::table('pedidos', function (Blueprint $table) {
                // Asegúrate de que el tipo de dato y si es nullable coincida
                // con cómo estaba definida antes, si lo recuerdas.
                // Si no, puedes ponerla nullable para evitar problemas al hacer rollback.
                 if (!Schema::hasColumn('pedidos', 'total')) {
                    $table->decimal('total', 8, 2)->nullable()->after('cliente_telefono');
                 }
            });
        }
    };