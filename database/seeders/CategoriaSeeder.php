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
            'nombre' => 'Tequila'
        ]);

        #2
        DB::table('categorias')->insert([
            'nombre' => 'Vodka'
        ]);

        #3
        DB::table('categorias')->insert([
            'nombre' => 'Ron'
        ]);

        #4
        DB::table('categorias')->insert([
            'nombre' => 'Refresco'
        ]);

        #5
        DB::table('categorias')->insert([
            'nombre' => 'Jugos y Jarabes'
        ]);

        #6
        DB::table('categorias')->insert([
            'nombre' => 'Licores'
        ]);
        #7
        DB::table('categorias')->insert([
            'nombre' => 'Solidos'
        ]);
    }
}
