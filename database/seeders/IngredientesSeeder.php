<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredientes')->insert([
            'idCategoria' => 1,
            'marca' => 'Cazadores',
            'precio' => 25.00,
            'cantidad' => 2000,
            'posicion' => 1
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 2,
            'marca' => 'Smirnoff',
            'precio' => 35.00,
            'cantidad' => 2000,
            'posicion' => 2
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 6,
            'marca' => 'Controy',
            'precio' => 25.00,
            'cantidad' => 2000,
            'posicion' => 3
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 4,
            'marca' => 'Squirt',
            'precio' => 10.00,
            'cantidad' => 2000,
            'posicion' => 4
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 5,
            'marca' => 'Jarabe Natural',
            'precio' => 10.00,
            'cantidad' => 2000,
            'posicion' => 5
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 5,
            'marca' => 'Jugo de Arandano',
            'precio' => 12.00,
            'cantidad' => 2000,
            'posicion' => 6
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 5,
            'marca' => 'Jugo de Limón',
            'precio' => 15.00,
            'cantidad' => 2000,
            'posicion' => 7
        ]);

        /*DB::table('ingredientes')->insert([
            'idCategoria' => 0,
            'marca' => 'Sal',
            'precio' => 1,
            'cantidad' => 2000,
            'posicion' => 19
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 0,
            'marca' => 'Hielo',
            'precio' => 1,
            'cantidad' => 2000,
            'posicion' => 20
        ]);*/
    }
}
