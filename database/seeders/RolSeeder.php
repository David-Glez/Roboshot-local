<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'tipo' => 'Super Administrador'
        ]);

        DB::table('roles')->insert([
            'tipo' => 'Administrador'
        ]);

        DB::table('roles')->insert([
            'tipo' => 'Empleado'
        ]);
    }
}
