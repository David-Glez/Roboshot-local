<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Ingredientes;
use App\Models\RecetaIngrediente;
use App\Models\Recetas;
use App\Models\IngredientePosicion;

class RecetasDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ouncesToMl = 30;

        $appdata = getenv('APPDATA').'\roboshot\roboshotData\img\\';

        //////////////////////////////////////////////////
        // definir ingredientes

        // solidos
        $hielo = Ingredientes::create([
            'idCategoria' => 7,
            'marca' => 'Hielo',
            'precio' => 0.00,
            'precioCompra' => 0,
            'precioVenta' => 0
        ]);
        IngredientePosicion::create([
            'posicion' => 1,
            'idIngrediente' => $hielo->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        $sal = Ingredientes::create([
            'idCategoria' => 7,
            'marca' => 'Sal',
            'precio' => 0.00,
            'precioCompra' => 0,
            'precioVenta' => 0
        ]);
        IngredientePosicion::create([
            'posicion' => 2,
            'idIngrediente' => $sal->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        $azucar = Ingredientes::create([
            'idCategoria' => 7,
            'marca' => 'Azucar',
            'precio' => 0.00,
            'precioCompra' => 0,
            'precioVenta' => 0
        ]);
        IngredientePosicion::create([
            'posicion' => 3,
            'idIngrediente' => $azucar->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        // 1, 2, 3 alcohol
        $tequila = Ingredientes::create([
            'idCategoria' => 1,
            'marca' => 'Cazadores',
            'precio' => 600 / 400 * 10,
            'precioCompra' => 400,
            'precioVenta' => 600
        ]);
        IngredientePosicion::create([
            'posicion' => 4,
            'idIngrediente' => $tequila->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        $vodka = Ingredientes::create([
            'idCategoria' => 2,
            'marca' => 'Smirnoff',
            'precio' => 600 / 300 * 10,
            'precioCompra' => 300,
            'precioVenta' => 600
        ]);
        IngredientePosicion::create([
            'posicion' => 5,
            'idIngrediente' => $vodka->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        $ron = Ingredientes::create([
            'idCategoria' => 3,
            'marca' => 'Bacardi',
            'precio' => 400 / 250 * 10,
            'precioCompra' => 250,
            'precioVenta' => 400
        ]);
        IngredientePosicion::create([
            'posicion' => 6,
            'idIngrediente' => $ron->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        // 4 refrescos
        $coca_cola = Ingredientes::create([
            'idCategoria' => 4,
            'marca' => 'Coca-Cola',
            'precio' => 90 / 30 * 10,
            'precioCompra' => 30,
            'precioVenta' => 90
        ]);
        IngredientePosicion::create([
            'posicion' => 7,
            'idIngrediente' => $coca_cola->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        $refresco_toronja = Ingredientes::create([
            'idCategoria' => 4,
            'marca' => 'Toronja',
            'precio' => 90 / 30 * 10,
            'precioCompra' => 30,
            'precioVenta' => 90
        ]);
        IngredientePosicion::create([
            'posicion' => 8,
            'idIngrediente' => $refresco_toronja->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        $agua_mineral = Ingredientes::create([
            'idCategoria' => 4,
            'marca' => 'Agua Mineral',
            'precio' => 90 / 30 * 10,
            'precioCompra' => 30,
            'precioVenta' => 90
        ]);
        IngredientePosicion::create([
            'posicion' => 9,
            'idIngrediente' => $agua_mineral->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        // 5 jugos y jarabes
        $jugo_naranja = Ingredientes::create([
            'idCategoria' => 5,
            'marca' => 'Jugo de Naranja',
            'precio' => 90 / 30 * 10,
            'precioCompra' => 10,
            'precioVenta' => 40
        ]);
        IngredientePosicion::create([
            'posicion' => 10,
            'idIngrediente' => $jugo_naranja->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        $jugo_arandano = Ingredientes::create([
            'idCategoria' => 5,
            'marca' => 'Jugo de Arandano',
            'precio' => 70 / 20 * 10,
            'precioCompra' => 20,
            'precioVenta' => 70
        ]);
        IngredientePosicion::create([
            'posicion' => 11,
            'idIngrediente' => $jugo_arandano->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        $sangrita = Ingredientes::create([
            'idCategoria' => 5,
            'marca' => 'Sangrita',
            'precio' => 70 / 20 * 10,
            'precioCompra' => 20,
            'precioVenta' => 70
        ]);
        IngredientePosicion::create([
            'posicion' => 12,
            'idIngrediente' => $sangrita->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        $granadina = Ingredientes::create([
            'idCategoria' => 5,
            'marca' => 'Granadina',
            'precio' => 70 / 20 * 10,
            'precioCompra' => 20,
            'precioVenta' => 70
        ]);
        IngredientePosicion::create([
            'posicion' => 13,
            'idIngrediente' => $granadina->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        $limon = Ingredientes::create([
            'idCategoria' => 5,
            'marca' => 'Jugo de Limon',
            'precio' => 50 / 10 * 10,
            'precioCompra' => 5,
            'precioVenta' => 50
        ]);
        IngredientePosicion::create([
            'posicion' => 14,
            'idIngrediente' => $limon->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        // 6 licores
        $cointreau = Ingredientes::create([
            'idCategoria' => 5,
            'marca' => 'Cointreau',
            'precio' => 1100 / 600 * 10,
            'precioCompra' => 600,
            'precioVenta' => 1100
        ]);
        IngredientePosicion::create([
            'posicion' => 15,
            'idIngrediente' => $cointreau->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        // 7 salsas
        $inglesa = Ingredientes::create([
            'idCategoria' => 5,
            'marca' => 'Inglesa',
            'precio' => 90 / 30 * 10,
            'precioCompra' => 30,
            'precioVenta' => 90
        ]);
        IngredientePosicion::create([
            'posicion' => 16,
            'idIngrediente' => $inglesa->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000,
        ]);

        $tabasco = Ingredientes::create([
            'idCategoria' => 5,
            'marca' => 'Tabasco',
            'precio' => 90 / 30 * 10,
            'precioCompra' => 30,
            'precioVenta' => 90
        ]);
        IngredientePosicion::create([
            'posicion' => 17,
            'idIngrediente' => $tabasco->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 1000,
        ]);


        //////////////////////////////////////////////////
        // bebidas

        //////////////////////////////////////////////////
        // 1 - ron collins
        $ron_collins = Recetas::create([
        	'nombre' => 'Ron Collins',
			'descripcion' => 'Ron Collins',
            'precio' => 80,
            'activa' => true,
            'img' => $appdata.'ron_collins.png',
            'mezclar' => true
        ]);

        RecetaIngrediente::create(['idReceta' => $ron_collins->idReceta,'idIngrediente' => $ron->idIngrediente, 'cantidad' => 50 ]);
        RecetaIngrediente::create(['idReceta' => $ron_collins->idReceta,'idIngrediente' => $azucar->idIngrediente, 'cantidad' => 1 ]);
        RecetaIngrediente::create(['idReceta' => $ron_collins->idReceta,'idIngrediente' => $limon->idIngrediente, 'cantidad' => 15 ]);
        RecetaIngrediente::create(['idReceta' => $ron_collins->idReceta,'idIngrediente' => $agua_mineral->idIngrediente, 'cantidad' => 120 ]);

        //////////////////////////////////////////////////
        // 2 - cuba libre
        $cuba_libre = Recetas::create([
        	'nombre' => 'Cuba Libre',
			'descripcion' => 'Cuba libre',
            'precio' => 60,
            'activa' => true,
            'img' => $appdata.'cuba_libre.png',
            'mezclar' => true
        ]);

        RecetaIngrediente::create(['idReceta' => $cuba_libre->idReceta,'idIngrediente' => $ron->idIngrediente, 'cantidad' => 50 ]);
        RecetaIngrediente::create(['idReceta' => $cuba_libre->idReceta,'idIngrediente' => $coca_cola->idIngrediente, 'cantidad' => 100 ]);
        RecetaIngrediente::create(['idReceta' => $cuba_libre->idReceta,'idIngrediente' => $limon->idIngrediente, 'cantidad' => 2 ]);
        RecetaIngrediente::create(['idReceta' => $cuba_libre->idReceta,'idIngrediente' => $hielo->idIngrediente, 'cantidad' =>  50]);

        //////////////////////////////////////////////////
        // 3 - bacardi coctel
        $bacardi_coctel = Recetas::create([
        	'nombre' => 'Bacardi Coctel',
			'descripcion' => 'Bacardi Coctel',
            'precio' => 75,
            'activa' => true,
            'img' => $appdata.'bacardi_coctel.png',
            'mezclar' => true
        ]);

        RecetaIngrediente::create(['idReceta' => $bacardi_coctel->idReceta,'idIngrediente' => $ron->idIngrediente, 'cantidad' => 60 ]);
        RecetaIngrediente::create(['idReceta' => $bacardi_coctel->idReceta,'idIngrediente' => $limon->idIngrediente, 'cantidad' => 22.5 ]);
        RecetaIngrediente::create(['idReceta' => $bacardi_coctel->idReceta,'idIngrediente' => $granadina->idIngrediente, 'cantidad' => 22.5 ]);

        //////////////////////////////////////////////////
        // 4 - daiquiri
        $daiquiri = Recetas::create([
        	'nombre' => 'Daiquiri',
			'descripcion' => 'Daiquiri',
            'precio' => 90,
            'activa' => true,
            'img' => $appdata.'daiquiri.png',
            'mezclar' => true
        ]);

        RecetaIngrediente::create(['idReceta' => $daiquiri->idReceta,'idIngrediente' => $ron->idIngrediente, 'cantidad' => 60 ]);
        RecetaIngrediente::create(['idReceta' => $daiquiri->idReceta,'idIngrediente' => $limon->idIngrediente, 'cantidad' => 30 ]);
        RecetaIngrediente::create(['idReceta' => $daiquiri->idReceta,'idIngrediente' => $azucar->idIngrediente, 'cantidad' => 2 ]);

        //////////////////////////////////////////////////
        // 5 - cosmopolitan
        $cosmopolitan = Recetas::create([
        	'nombre' => 'Cosmopolitan',
			'descripcion' => 'Cosmopolitan',
            'precio' => 90,
            'activa' => true,
            'img' => $appdata.'cosmopolitan.png',
            'mezclar' => true
        ]);

        RecetaIngrediente::create(['idReceta' => $cosmopolitan->idReceta,'idIngrediente' => $vodka->idIngrediente, 'cantidad' => 1.5 * $ouncesToMl ]);
        RecetaIngrediente::create(['idReceta' => $cosmopolitan->idReceta,'idIngrediente' => $jugo_arandano->idIngrediente, 'cantidad' => 1.5 * $ouncesToMl ]);
        RecetaIngrediente::create(['idReceta' => $cosmopolitan->idReceta,'idIngrediente' => $limon->idIngrediente, 'cantidad' => .4 * $ouncesToMl ]);
        RecetaIngrediente::create(['idReceta' => $cosmopolitan->idReceta,'idIngrediente' => $cointreau->idIngrediente, 'cantidad' => .85 * $ouncesToMl ]);

        //////////////////////////////////////////////////
        // 6 - paloma rusa
        $paloma_rusa = Recetas::create([
        	'nombre' => 'Paloma Rusa',
			'descripcion' => 'Paloma Rusa',
            'precio' => 70,
            'activa' => true,
            'img' => $appdata.'paloma_rusa.png',
            'mezclar' => true
        ]);

        RecetaIngrediente::create(['idReceta' => $paloma_rusa->idReceta,'idIngrediente' => $vodka->idIngrediente, 'cantidad' => 1.5 * $ouncesToMl ]);
        RecetaIngrediente::create(['idReceta' => $paloma_rusa->idReceta,'idIngrediente' => $refresco_toronja->idIngrediente, 'cantidad' => 6 * $ouncesToMl ]);
        RecetaIngrediente::create(['idReceta' => $paloma_rusa->idReceta,'idIngrediente' => $tabasco->idIngrediente, 'cantidad' => 2 ]);
        RecetaIngrediente::create(['idReceta' => $paloma_rusa->idReceta,'idIngrediente' => $sal->idIngrediente, 'cantidad' => 1 ]);

        //////////////////////////////////////////////////
        // 7 - desarmador
        $desarmador = Recetas::create([
        	'nombre' => 'Desarmador',
			'descripcion' => 'Desarmador',
            'precio' => 45,
            'activa' => true,
            'img' => $appdata.'desarmador.png',
            'mezclar' => true
        ]);

        RecetaIngrediente::create(['idReceta' => $desarmador->idReceta,'idIngrediente' => $vodka->idIngrediente, 'cantidad' => 1.5 * $ouncesToMl ]);
        RecetaIngrediente::create(['idReceta' => $desarmador->idReceta,'idIngrediente' => $jugo_naranja->idIngrediente, 'cantidad' => 3 * $ouncesToMl ]);

        //////////////////////////////////////////////////
        // 8 - vampiro
        $vampiro = Recetas::create([
        	'nombre' => 'Vampiro',
			'descripcion' => 'Vampiro',
            'precio' => 95,
            'activa' => true,
            'img' => $appdata.'vampiro.png',
            'mezclar' => true
        ]);

        RecetaIngrediente::create(['idReceta' => $vampiro->idReceta,'idIngrediente' => $tequila->idIngrediente, 'cantidad' => 1.5 * $ouncesToMl ]);
        RecetaIngrediente::create(['idReceta' => $vampiro->idReceta,'idIngrediente' => $sangrita->idIngrediente, 'cantidad' => 3 * $ouncesToMl ]);
        RecetaIngrediente::create(['idReceta' => $vampiro->idReceta,'idIngrediente' => $refresco_toronja->idIngrediente, 'cantidad' => 1.5 * $ouncesToMl ]);
        RecetaIngrediente::create(['idReceta' => $vampiro->idReceta,'idIngrediente' => $inglesa->idIngrediente, 'cantidad' => 1 ]);
        RecetaIngrediente::create(['idReceta' => $vampiro->idReceta,'idIngrediente' => $limon->idIngrediente, 'cantidad' => 30 ]);
        RecetaIngrediente::create(['idReceta' => $vampiro->idReceta,'idIngrediente' => $sal->idIngrediente, 'cantidad' => 1 ]);

        //////////////////////////////////////////////////
        // 9 - paloma
        $paloma = Recetas::create([
        	'nombre' => 'Paloma',
			'descripcion' => 'Paloma',
            'precio' => 40,
            'activa' => true,
            'img' => $appdata.'paloma.png',
            'mezclar' => true
        ]);

        RecetaIngrediente::create(['idReceta' => $paloma->idReceta,'idIngrediente' => $tequila->idIngrediente, 'cantidad' => 2 * $ouncesToMl ]);
        RecetaIngrediente::create(['idReceta' => $paloma->idReceta,'idIngrediente' => $refresco_toronja->idIngrediente, 'cantidad' => 700 ]);
        RecetaIngrediente::create(['idReceta' => $paloma->idReceta,'idIngrediente' => $sal->idIngrediente, 'cantidad' => 2 ]);
        RecetaIngrediente::create(['idReceta' => $paloma->idReceta,'idIngrediente' => $limon->idIngrediente, 'cantidad' => 20 ]);

        //////////////////////////////////////////////////
        // 9 - paloma
        $tequila_sunrise = Recetas::create([
        	'nombre' => 'Tequila Sunrise',
			'descripcion' => 'Tequila Sunrise',
            'precio' => 90,
            'activa' => true,
            'img' => $appdata.'tequila_sunrise.png',
            'mezclar' => true
        ]);

        RecetaIngrediente::create(['idReceta' => $tequila_sunrise->idReceta,'idIngrediente' => $tequila->idIngrediente, 'cantidad' => 4 * $ouncesToMl ]);
        RecetaIngrediente::create(['idReceta' => $tequila_sunrise->idReceta,'idIngrediente' => $jugo_naranja->idIngrediente, 'cantidad' => 6 * $ouncesToMl ]);
        RecetaIngrediente::create(['idReceta' => $tequila_sunrise->idReceta,'idIngrediente' => $granadina->idIngrediente, 'cantidad' => 1 * $ouncesToMl ]);
    }
}
