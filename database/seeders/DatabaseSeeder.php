<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call(RolSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(IngredientesSeeder::class);
        $this->call(RecetaSeeder::class);
<<<<<<< HEAD
        $this->call(VentasSeeder::class);
        //$this->call(RecetaIngredienteSeeder::class);
=======
>>>>>>> 6e56a680f82c7fe0ce9829f2a8774b54495e0950

    }
}
