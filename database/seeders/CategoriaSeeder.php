<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #1
        DB::table('categorias')->insert([
            'nombre' => 'Tequila',
            'grupo' => 4
        ]);

        #2
        DB::table('categorias')->insert([
            'nombre' => 'Vodka',
            'grupo' => 4
        ]);

        #3
        DB::table('categorias')->insert([
            'nombre' => 'Ron',
            'grupo' => 4
        ]);

        #4
        DB::table('categorias')->insert([
            'nombre' => 'Refresco',
            'grupo' => 3
        ]);

        #5
        DB::table('categorias')->insert([
            'nombre' => 'Jugos y Jarabes',
            'grupo' => 3
        ]);

        #6
        DB::table('categorias')->insert([
            'nombre' => 'Licores',
            'grupo' => 4
        ]);
        #7
        DB::table('categorias')->insert([
            'nombre' => 'Solidos',
            'grupo' => 1
        ]);
        #8
        DB::table('categorias')->insert([
            'nombre' => 'Salsas',
            'grupo' => 2
        ]);
    }
}
