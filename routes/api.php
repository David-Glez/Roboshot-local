<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

// rutas inicio de sesion
Route::post('/login', 'InicioController@inicioSesion');

// rutas para recetas
Route::get('/recetas', 'RecetasController@inicio');
Route::get('/prueba', 'RecetasController@prueba');
Route::post('/recetas/nuevo', 'RecetasController@anadirReceta');
Route::get('/recetas/busca/{idReceta}', 'RecetasController@buscaReceta');
Route::post('/recetas/descuenta', 'RecetasController@descuentaIngredientes');
Route::post('/recetas/descuenta/personalizado', 'RecetasController@descuentaIngredientesPersonalizado');

//rutas para ingredientes
Route::get('/ingredientes', 'IngredientesController@inicio');
Route::post('/ingredientes/nuevo', 'IngredientesController@anadirIngrediente');
Route::post('/ingredientes/eliminar', 'IngredientesController@eliminarIngrediente');
Route::get('/ingredientes/{categoria}', 'IngredientesController@ingredienteCategoria');

//rutas para categorias
Route::get('/categorias', 'CategoriasController@inicio');
Route::post('/categorias/nuevo', 'CategoriasController@anadirCategoria');

//rutas para ventas
Route::get('/ventas', 'VentasController@index');
