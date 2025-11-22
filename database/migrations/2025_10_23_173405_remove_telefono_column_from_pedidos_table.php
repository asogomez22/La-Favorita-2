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
            // Comprovar si la columna 'telefono' existeix abans d'intentar esborrar-la
            if (Schema::hasColumn('pedidos', 'telefono')) {
                Schema::table('pedidos', function (Blueprint $table) {
                    $table->dropColumn('telefono');
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
            // Si desfem, tornem a afegir la columna (per si de cas)
             Schema::table('pedidos', function (Blueprint $table) {
                 if (!Schema::hasColumn('pedidos', 'telefono')) {
                    // Intenta recordar com estava definida, o posa-la nullable
                    $table->string('telefono')->nullable()->after('cliente_nombre'); 
                 }
            });
        }
    };
   