<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientePosicionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('ingredientePosicion')->insert([
            'idIngrediente' => 1,
            'posicion' => 1, 
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);
        DB::table('ingredientePosicion')->insert([
            'idIngrediente' => 2,
            'posicion' => 2, 
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);
        DB::table('ingredientePosicion')->insert([
            'idIngrediente' => 3,
            'posicion' => 3, 
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);
        DB::table('ingredientePosicion')->insert([
            'idIngrediente' => 4,
            'posicion' => 4, 
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);
        DB::table('ingredientePosicion')->insert([
            'idIngrediente' => 5,
            'posicion' => 5, 
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);
        DB::table('ingredientePosicion')->insert([
            'idIngrediente' => 6,
            'posicion' => 6, 
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);
        DB::table('ingredientePosicion')->insert([
            'idIngrediente' => 7,
            'posicion' => 7, 
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);
        DB::table('ingredientePosicion')->insert([
            'idIngrediente' => 8,
            'posicion' => 10, 
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);
        DB::table('ingredientePosicion')->insert([
            'idIngrediente' => 9,
            'posicion' => 11, 
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);
        DB::table('ingredientePosicion')->insert([
            'idIngrediente' => 10,
            'posicion' => 12, 
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);
    }
}
