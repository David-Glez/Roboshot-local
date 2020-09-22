<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecetaIngredienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        #paloma
        #hielo
        DB::table('recetaIngrediente')->insert([
        	'idReceta' => 1,
            'idIngrediente' => 9,
            'cantidad' => 40
        ]);

        #Tequila
        DB::table('recetaIngrediente')->insert([
        	'idReceta' => 1,
            'idIngrediente' => 1,
            'cantidad' => 60
        ]);

        #limon
        DB::table('recetaIngrediente')->insert([
        	'idReceta' => 1,
            'idIngrediente' => 6,
            'cantidad' => 10
        ]);

        #sal
        DB::table('recetaIngrediente')->insert([
        	'idReceta' => 1,
            'idIngrediente' => 8,
            'cantidad' => 5
        ]);

        #Toronja
        DB::table('recetaIngrediente')->insert([
        	'idReceta' => 1,
            'idIngrediente' => 5,
            'cantidad' => 230
        ]);

        #Cosmopolitan
        #hielo
        DB::table('recetaIngrediente')->insert([
        	'idReceta' => 2,
            'idIngrediente' => 9,
            'cantidad' => 20
        ]);

        #Controy
        DB::table('recetaIngrediente')->insert([
        	'idReceta' => 2,
            'idIngrediente' => 3,
            'cantidad' => 30
        ]);

        #Arandano
        DB::table('recetaIngrediente')->insert([
        	'idReceta' => 2,
            'idIngrediente' => 6,
            'cantidad' => 60
        ]);

        #Vodka
        DB::table('recetaIngrediente')->insert([
        	'idReceta' => 2,
            'idIngrediente' => 2,
            'cantidad' => 60
        ]);

        #limon
        DB::table('recetaIngrediente')->insert([
        	'idReceta' => 2,
            'idIngrediente' => 7,
            'cantidad' => 2
        ]);

        #jarabe natural
        DB::table('recetaIngrediente')->insert([
        	'idReceta' => 2,
            'idIngrediente' => 5,
            'cantidad' => 40
        ]);
    }
}
