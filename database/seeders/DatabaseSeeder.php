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
        $this->call(VentasSeeder::class);
        //$this->call(RecetaIngredienteSeeder::class);

    }
}
