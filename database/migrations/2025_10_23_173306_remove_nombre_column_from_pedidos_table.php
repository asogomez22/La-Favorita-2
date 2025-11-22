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
            // Comprovar si la columna 'nombre' existeix abans d'intentar esborrar-la
            if (Schema::hasColumn('pedidos', 'nombre')) {
                Schema::table('pedidos', function (Blueprint $table) {
                    $table->dropColumn('nombre');
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
                 if (!Schema::hasColumn('pedidos', 'nombre')) {
                    // Intenta recordar com estava definida, o posa-la nullable
                    $table->string('nombre')->nullable()->after('id'); 
                 }
            });
        }
    };