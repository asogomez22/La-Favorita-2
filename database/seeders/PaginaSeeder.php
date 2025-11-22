<?php

namespace Database\Seeders; // <-- Verifica aquest namespace

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pagina; // <-- Verifica aquest 'use'

class PaginaSeeder extends Seeder // <-- Verifica aquest nom de classe
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Utilitzar updateOrCreate per evitar errors si ja existeixen
        Pagina::updateOrCreate(
            ['slug' => 'inicio'], // Clau per buscar
            [ // Dades per crear o actualitzar
                'titulo' => 'Página de Inicio',
                'contenido' => '<h2>¡Bienvenido a La Favorita Xeeskeyk!</h2><p>Este es el contenido de tu página de inicio. Puedes editar este texto desde el panel de administración.</p>'
            ]
        );

        Pagina::updateOrCreate(
             ['slug' => 'quienes-somos'], // Clau per buscar
             [ // Dades per crear o actualitzar
                'titulo' => 'Quiénes Somos',
                'contenido' => '<h2>Nuestra Historia</h2><p>Somos una pastelería en Reus especializada en los cheesecakes más increíbles. ¡Edita esto en el panel de admin!</p>'
             ]
        );
    }
}
