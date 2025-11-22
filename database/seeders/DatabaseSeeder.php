<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Pots tenir altres factories comentades aquí, però assegura't que la de 'test@example.com' HO ESTÀ
        // \App\Models\User::factory(10)->create();

        // Aquesta és la línia que crea l'usuari duplicat -> COMENTA-LA o ELIMINA-LA
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // *** AQUESTA LÍNIA SÍ QUE L'HEM DE TENIR DESCOMENTADA ***
        $this->call(PaginaSeeder::class); 
    }
}
