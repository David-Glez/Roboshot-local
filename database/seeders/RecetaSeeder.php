<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recetas')->insert([
        	'nombre' => 'Personalizada',
			'descripcion' => 'Bebida personalizada por el cliente',
            'precio' => 0.0,
            'activa' => false,
            'img' => '/images/camera.jpg'
        ]);
        /*DB::table('recetas')->insert([
        	'nombre' => 'Paloma',
			'descripcion' => 'Bebida de tequila con refresco de toronja',
            'precio' => 25.00,
            'activa' => true,
            'img' => '/images/camera.jpg'
        ]);

        DB::table('recetas')->insert([
        	'nombre' => 'Cosmopolitan',
			'descripcion' => 'Bebida de vodka con jugo de arandano, Controy y jarabe natual',
            'precio' => 30.00,
            'activa' => true,
            'img' => '/images/camera.jpg'
        ]);*/
    }
}
