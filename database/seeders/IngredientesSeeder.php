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
            'cantidadTotal' => 2000,
            'cantidadDisponible' => 2000,
            'posicion' => 1,
            'precioCompra' => 600,
            'precioVenta' => 5000
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 2,
            'marca' => 'Smirnoff',
            'precio' => 35.00,
            'cantidadTotal' => 2000,
            'cantidadDisponible' => 2000,
            'posicion' => 2,
            'precioCompra' => 700,
            'precioVenta' => 7000
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 6,
            'marca' => 'Controy',
            'precio' => 25.00,
            'cantidadTotal' => 2000,
            'cantidadDisponible' => 2000,
            'posicion' => 3, 
            'precioCompra' => 700,
            'precioVenta' => 5000
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 4,
            'marca' => 'Squirt',
            'precio' => 10.00,
            'cantidadTotal' => 2000,
            'cantidadDisponible' => 2000,
            'posicion' => 4,
            'precioCompra' => 30,
            'precioVenta' => 2000
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 5,
            'marca' => 'Jarabe Natural',
            'precio' => 10.00,
            'cantidadTotal' => 2000,
            'cantidadDisponible' => 2000,
            'posicion' => 5, 
            'precioCompra' => 70,
            'precioVenta' => 2000
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 5,
            'marca' => 'Jugo de Arandano',
            'precio' => 12.00,
            'cantidadTotal' => 2000,
            'cantidadDisponible' => 2000,
            'posicion' => 6,
            'precioCompra' => 70,
            'precioVenta' => 2400
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 5,
            'marca' => 'Jugo de Limón',
            'precio' => 15.00,
            'cantidadTotal' => 2000,
            'cantidadDisponible' => 2000,
            'posicion' => 7,
            'precioCompra' => 70,
            'precioVenta' => 3000
        ]);

        /*DB::table('ingredientes')->insert([
            'idCategoria' => 0,
            'marca' => 'Sal',
            'precio' => 1,
            'cantidadTotal' => 2000,
            'cantidadDisponible' => 2000,
            'posicion' => 19
        ]);

        DB::table('ingredientes')->insert([
            'idCategoria' => 0,
            'marca' => 'Hielo',
            'precio' => 1,
            'cantidadTotal' => 2000,
            'cantidadDisponible' => 2000,
            'posicion' => 20
        ]);*/
    }
}
