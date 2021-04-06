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
            //'cantidadDisponible' => 2000,
            //'posicion' => 1,
            'precioCompra' => 600,
            'precioVenta' => 5000
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 2,
            'marca' => 'Smirnoff',
            //'cantidadDisponible' => 2000,
            //'posicion' => 2,
            'precioCompra' => 700,
            'precioVenta' => 7000
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 6,
            'marca' => 'Controy',
            //'cantidadDisponible' => 2000,
            //'posicion' => 3, 
            'precioCompra' => 700,
            'precioVenta' => 5000
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 4,
            'marca' => 'Squirt',
            //'cantidadDisponible' => 2000,
            //'posicion' => 4,
            'precioCompra' => 30,
            'precioVenta' => 2000
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 5,
            'marca' => 'Jarabe Natural',
            //'cantidadDisponible' => 2000,
            //'posicion' => 5, 
            'precioCompra' => 70,
            'precioVenta' => 2000
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 5,
            'marca' => 'Jugo de Arandano',
            //'cantidadDisponible' => 2000,
            //'posicion' => 6,
            'precioCompra' => 70,
            'precioVenta' => 2400
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 8,
            'marca' => 'Jugo de Limón',
            //'cantidadDisponible' => 2000,
            //'posicion' => 7,
            'precioCompra' => 70,
            'precioVenta' => 3000
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 7,
            'marca' => 'Sal',
            //'cantidadDisponible' => 1000,
            //'posicion' => 8,
            'precioCompra' => 70,
            'precioVenta' => 150
        ]);
        DB::table('ingredientes')->insert([
            'idCategoria' => 7,
            'marca' => 'Chile en Polvo',
            //'cantidadDisponible' => 1000,
            //'posicion' => 9,
            'precioCompra' => 70,
            'precioVenta' => 150
        ]);
        /*DB::table('ingredientes')->insert([
            'idCategoria' => 7,
            'marca' => 'Mezclador',
            'cantidadTotal' => 0,
            'cantidadDisponible' => 0,
            'posicion' => 10,
            'precioCompra' => 0,
            'precioVenta' => 0
        ]);*/
        DB::table('ingredientes')->insert([
            'idCategoria' => 5,
            'marca' => 'Jugo de Toronja',
            //'cantidadDisponible' => 2000,
            //'posicion' => 6,
            'precioCompra' => 70,
            'precioVenta' => 2400
        ]);
        DB::table('ingredientes')->insert([
            'idCategoria' => 7,
            'marca' => 'Hielo',
            //'cantidadDisponible' => 1000,
            //'posicion' => 11,
            'precioCompra' => 0,
            'precioVenta' => 0
        ]);
        /*
        DB::table('ingredientes')->insert([
            'idCategoria' => 0,
            'marca' => 'Hielo',
            'cantidadTotal' => 2000,
            'cantidadDisponible' => 2000,
            'posicion' => 20
        ]);*/
    }
}
