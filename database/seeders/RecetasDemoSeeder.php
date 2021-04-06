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

        // 7solidos
        $hielo = Ingredientes::create([
            'idCategoria' => 8,
            'marca' => 'Hielo',
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
            'idCategoria' => 8,
            'marca' => 'Sal',
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
            'idCategoria' => 8,
            'marca' => 'Azucar',
            'precioCompra' => 0,
            'precioVenta' => 0
        ]);
        IngredientePosicion::create([
            'posicion' => 3,
            'idIngrediente' => $azucar->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        // 1 = tequila, 2 = vodka, 3 = Ron, 4 = whisky alcohol
        $cazadores = Ingredientes::create([
            'idCategoria' => 1,
            'marca' => 'Cazadores',
            'precioCompra' => 400,
            'precioVenta' => 600
        ]);
        IngredientePosicion::create([
            'posicion' => 16,
            'idIngrediente' => $cazadores->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        $don_julio = Ingredientes::create([
            'idCategoria' => 1,
            'marca' => 'Don Julio',
            'precioCompra' => 400,
            'precioVenta' => 600
        ]);
        IngredientePosicion::create([
            'posicion' => 18,
            'idIngrediente' => $don_julio->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        $vodka = Ingredientes::create([
            'idCategoria' => 2,
            'marca' => 'Absolut',
            'precioCompra' => 300,
            'precioVenta' => 600
        ]);
        IngredientePosicion::create([
            'posicion' => 15,
            'idIngrediente' => $vodka->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        $ronB = Ingredientes::create([
            'idCategoria' => 3,
            'marca' => 'Bacardi',
            'precioCompra' => 250,
            'precioVenta' => 400
        ]);
        IngredientePosicion::create([
            'posicion' => 14,
            'idIngrediente' => $ronB->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        $ronH = Ingredientes::create([
            'idCategoria' => 3,
            'marca' => 'Havana Club',
            'precioCompra' => 250,
            'precioVenta' => 400
        ]);
        IngredientePosicion::create([
            'posicion' => 17,
            'idIngrediente' => $ronH->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        $jack_daniels = Ingredientes::create([
            'idCategoria' => 4,
            'marca' => 'Jack Daniel´s',
            'precioCompra' => 250,
            'precioVenta' => 400
        ]);
        IngredientePosicion::create([
            'posicion' => 19,
            'idIngrediente' => $jack_daniels->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        // 4 refrescos
        $coca_cola = Ingredientes::create([
            'idCategoria' => 5,
            'marca' => 'Coca-Cola',
            'precioCompra' => 30,
            'precioVenta' => 90
        ]);
        IngredientePosicion::create([
            'posicion' => 13,
            'idIngrediente' => $coca_cola->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        $refresco_toronja = Ingredientes::create([
            'idCategoria' => 5,
            'marca' => 'Toronja',
            'precioCompra' => 30,
            'precioVenta' => 90
        ]);
        IngredientePosicion::create([
            'posicion' => 12,
            'idIngrediente' => $refresco_toronja->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        $agua_mineral = Ingredientes::create([
            'idCategoria' => 5,
            'marca' => 'Agua Mineral',
            'precioCompra' => 30,
            'precioVenta' => 90
        ]);
        IngredientePosicion::create([
            'posicion' => 10,
            'idIngrediente' => $agua_mineral->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        $agua_quina = Ingredientes::create([
            'idCategoria' => 5,
            'marca' => 'Agua Mineral',
            'precioCompra' => 30,
            'precioVenta' => 90
        ]);
        IngredientePosicion::create([
            'posicion' => 11,
            'idIngrediente' => $agua_quina->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        // 5 jugos y jarabes
        $jugo_naranja = Ingredientes::create([
            'idCategoria' => 6,
            'marca' => 'Jugo de Naranja',
            'precioCompra' => 10,
            'precioVenta' => 40
        ]);
        IngredientePosicion::create([
            'posicion' => 8,
            'idIngrediente' => $jugo_naranja->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        /*$jugo_arandano = Ingredientes::create([
            'idCategoria' => 5,
            'marca' => 'Jugo de Arandano',
            'precioCompra' => 20,
            'precioVenta' => 70
        ]);
        IngredientePosicion::create([
            'posicion' => 15,
            'idIngrediente' => $jugo_arandano->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);*/

        $sangrita = Ingredientes::create([
            'idCategoria' => 6,
            'marca' => 'Sangrita',
            'precioCompra' => 20,
            'precioVenta' => 70
        ]);
        IngredientePosicion::create([
            'posicion' => 9,
            'idIngrediente' => $sangrita->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        $granadina = Ingredientes::create([
            'idCategoria' => 6,
            'marca' => 'Granadina',
            'precioCompra' => 20,
            'precioVenta' => 70
        ]);
        IngredientePosicion::create([
            'posicion' => 7,
            'idIngrediente' => $granadina->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);

        // 6 licores
        /*$cointreau = Ingredientes::create([
            'idCategoria' => 5,
            'marca' => 'Cointreau',
            'precioCompra' => 600,
            'precioVenta' => 1100
        ]);
        IngredientePosicion::create([
            'posicion' => 18,
            'idIngrediente' => $cointreau->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);*/

        // 8 salsas
        $limon = Ingredientes::create([
            'idCategoria' => 9,
            'marca' => 'Jugo de Limon',
            'precioCompra' => 5,
            'precioVenta' => 50
        ]);
        IngredientePosicion::create([
            'posicion' => 6,
            'idIngrediente' => $limon->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000
        ]);
        $inglesa = Ingredientes::create([
            'idCategoria' => 9,
            'marca' => 'Inglesa',
            'precioCompra' => 30,
            'precioVenta' => 90
        ]);
        IngredientePosicion::create([
            'posicion' => 4,
            'idIngrediente' => $inglesa->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 2000,
        ]);

        $tabasco = Ingredientes::create([
            'idCategoria' => 9,
            'marca' => 'Tabasco',
            'precioCompra' => 30,
            'precioVenta' => 90
        ]);
        IngredientePosicion::create([
            'posicion' => 5,
            'idIngrediente' => $tabasco->idIngrediente,
            'cantidad' => 2000,
            'cantidadTotal' => 1000,
        ]);


        //////////////////////////////////////////////////
        // bebidas

        //////////////////////////////////////////////////
        // 1 - ron collins
        /*$ron_collins = Recetas::create([
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
        RecetaIngrediente::create(['idReceta' => $ron_collins->idReceta,'idIngrediente' => $agua_mineral->idIngrediente, 'cantidad' => 120 ]);*/
        /////////////////////////////////////////////////
        // 1- cuba libre bacardi
        $cuba_libre_bacardi = Recetas::create([
        	'nombre' => 'Cuba Libre Bacardi',
			'descripcion' => 'Cuba libre con bacardi',
            'precio' => 60,
            'activa' => true,
            'img' => $appdata.'cuba_libre.png',
            'mezclar' => true
        ]);

        RecetaIngrediente::create(['idReceta' => $cuba_libre_bacardi->idReceta,'idIngrediente' => $ronB->idIngrediente, 'cantidad' => 45 , 'unidad' => 'shot']);
        RecetaIngrediente::create(['idReceta' => $cuba_libre_bacardi->idReceta,'idIngrediente' => $coca_cola->idIngrediente, 'cantidad' => 100, 'unidad' => 'ml' ]);
        RecetaIngrediente::create(['idReceta' => $cuba_libre_bacardi->idReceta,'idIngrediente' => $limon->idIngrediente, 'cantidad' => 2, 'unidad' => 'ml' ]);
        RecetaIngrediente::create(['idReceta' => $cuba_libre_bacardi->idReceta,'idIngrediente' => $hielo->idIngrediente, 'cantidad' =>  50, 'unidad' => 'grs']);
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

        RecetaIngrediente::create(['idReceta' => $cuba_libre->idReceta,'idIngrediente' => $ronH->idIngrediente, 'cantidad' => 45 , 'unidad' => 'shot']);
        /*RecetaIngrediente::create(['idReceta' => $cuba_libre->idReceta,'idIngrediente' => $coca_cola->idIngrediente, 'cantidad' => 100 ]);*/
        RecetaIngrediente::create(['idReceta' => $cuba_libre->idReceta,'idIngrediente' => $limon->idIngrediente, 'cantidad' => 15, 'unidad' => 'ml' ]);
        RecetaIngrediente::create(['idReceta' => $cuba_libre->idReceta,'idIngrediente' => $azucar->idIngrediente, 'cantidad' => 15, 'unidad' => 'cucharada' ]);
        RecetaIngrediente::create(['idReceta' => $cuba_libre->idReceta,'idIngrediente' => $agua_mineral->idIngrediente, 'cantidad' => 120, 'unidad' => 'ml' ]);
        RecetaIngrediente::create(['idReceta' => $cuba_libre->idReceta,'idIngrediente' => $hielo->idIngrediente, 'cantidad' =>  50, 'unidad' => 'grs']);

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

        RecetaIngrediente::create(['idReceta' => $bacardi_coctel->idReceta,'idIngrediente' => $ronB->idIngrediente, 'cantidad' => 45, 'unidad' => 'shot' ]);
        RecetaIngrediente::create(['idReceta' => $bacardi_coctel->idReceta,'idIngrediente' => $limon->idIngrediente, 'cantidad' => 23, 'unidad' => 'ml' ]);
        RecetaIngrediente::create(['idReceta' => $bacardi_coctel->idReceta,'idIngrediente' => $granadina->idIngrediente, 'cantidad' => 23, 'unidad' => 'ml' ]);

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

        RecetaIngrediente::create(['idReceta' => $daiquiri->idReceta,'idIngrediente' => $ronB->idIngrediente, 'cantidad' => 45, 'unidad' => 'shot' ]);
        RecetaIngrediente::create(['idReceta' => $daiquiri->idReceta,'idIngrediente' => $limon->idIngrediente, 'cantidad' => 30, 'unidad' => 'ml']);
        RecetaIngrediente::create(['idReceta' => $daiquiri->idReceta,'idIngrediente' => $azucar->idIngrediente, 'cantidad' => 30, 'unidad' => 'cucharada' ]);

        //////////////////////////////////////////////////
        // 5 - cosmopolitan
        /*$cosmopolitan = Recetas::create([
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
        RecetaIngrediente::create(['idReceta' => $cosmopolitan->idReceta,'idIngrediente' => $cointreau->idIngrediente, 'cantidad' => .85 * $ouncesToMl ]);*/

        //////////////////////////////////////////////////
        // 5 - Vodka tonic
        $vodka_tonic = Recetas::create([
        	'nombre' => 'Vodka Tonic',
			'descripcion' => 'Vodka Tonic',
            'precio' => 90,
            'activa' => true,
            'img' => $appdata.'cosmopolitan.png',
            'mezclar' => true
        ]);

        RecetaIngrediente::create(['idReceta' => $vodka_tonic->idReceta,'idIngrediente' => $vodka->idIngrediente, 'cantidad' => 45 , 'unidad' => 'shot']);
        RecetaIngrediente::create(['idReceta' => $vodka_tonic->idReceta,'idIngrediente' => $agua_quina->idIngrediente, 'cantidad' => 178, 'unidad' => 'ml' ]);
        RecetaIngrediente::create(['idReceta' => $vodka_tonic->idReceta,'idIngrediente' => $limon->idIngrediente, 'cantidad' => 2, 'unidad' => 'gota']);

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

        RecetaIngrediente::create(['idReceta' => $paloma_rusa->idReceta,'idIngrediente' => $vodka->idIngrediente, 'cantidad' => 45, 'unidad' => 'shot' ]);
        RecetaIngrediente::create(['idReceta' => $paloma_rusa->idReceta,'idIngrediente' => $refresco_toronja->idIngrediente, 'cantidad' => 178, 'unidad' => 'ml' ]);
        RecetaIngrediente::create(['idReceta' => $paloma_rusa->idReceta,'idIngrediente' => $tabasco->idIngrediente, 'cantidad' => 2 , 'unidad' => 'gota']);
        RecetaIngrediente::create(['idReceta' => $paloma_rusa->idReceta,'idIngrediente' => $sal->idIngrediente, 'cantidad' => 5, 'unidad' => 'pizca' ]);

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

        RecetaIngrediente::create(['idReceta' => $desarmador->idReceta,'idIngrediente' => $vodka->idIngrediente, 'cantidad' => 45, 'unidad' => 'shot' ]);
        RecetaIngrediente::create(['idReceta' => $desarmador->idReceta,'idIngrediente' => $jugo_naranja->idIngrediente, 'cantidad' => 90, 'unidad' => 'ml' ]);

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

        RecetaIngrediente::create(['idReceta' => $vampiro->idReceta,'idIngrediente' => $cazadores->idIngrediente, 'cantidad' => 45, 'unidad' => 'shot' ]);
        RecetaIngrediente::create(['idReceta' => $vampiro->idReceta,'idIngrediente' => $sangrita->idIngrediente, 'cantidad' => 90, 'unidad' => 'ml' ]);
        RecetaIngrediente::create(['idReceta' => $vampiro->idReceta,'idIngrediente' => $refresco_toronja->idIngrediente, 'cantidad' => 45, 'unidad' => 'ml' ]);
        RecetaIngrediente::create(['idReceta' => $vampiro->idReceta,'idIngrediente' => $inglesa->idIngrediente, 'cantidad' => 5, 'unidad' => 'ml' ]);
        RecetaIngrediente::create(['idReceta' => $vampiro->idReceta,'idIngrediente' => $limon->idIngrediente, 'cantidad' => 15, 'unidad' => 'limon' ]);
        RecetaIngrediente::create(['idReceta' => $vampiro->idReceta, 'idIngrediente' => $sal->idIngrediente, 'cantidad' => 5, 'unidad' => 'pizca' ]);

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

        RecetaIngrediente::create(['idReceta' => $paloma->idReceta,'idIngrediente' => $cazadores->idIngrediente, 'cantidad' => 45, 'unidad' => 'shot' ]);
        RecetaIngrediente::create(['idReceta' => $paloma->idReceta,'idIngrediente' => $refresco_toronja->idIngrediente, 'cantidad' => 120, 'unidad' => 'ml' ]);
        RecetaIngrediente::create(['idReceta' => $paloma->idReceta, 'idIngrediente' => $sal->idIngrediente, 'cantidad' => 5, 'unidad' => 'pizca' ]);
        RecetaIngrediente::create(['idReceta' => $paloma->idReceta,'idIngrediente' => $limon->idIngrediente, 'cantidad' => 15, 'unidad' => 'limon' ]);

        //////////////////////////////////////////////////
        // 10 - tequila Sunrise
        $cazadores_sunrise = Recetas::create([
        	'nombre' => 'Tequila Sunrise',
			'descripcion' => 'tequila Sunrise',
            'precio' => 90,
            'activa' => true,
            'img' => $appdata.'tequila_sunrise.png',
            'mezclar' => true
        ]);

        RecetaIngrediente::create(['idReceta' => $cazadores_sunrise->idReceta,'idIngrediente' => $cazadores->idIngrediente, 'cantidad' => 45, 'unidad' => 'shot' ]);
        RecetaIngrediente::create(['idReceta' => $cazadores_sunrise->idReceta,'idIngrediente' => $jugo_naranja->idIngrediente, 'cantidad' => 120, 'unidad' => 'ml' ]);
        RecetaIngrediente::create(['idReceta' => $cazadores_sunrise->idReceta,'idIngrediente' => $granadina->idIngrediente, 'cantidad' => 25, 'unidad' => 'ml' ]);
    }
}
