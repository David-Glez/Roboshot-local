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
Route::post('/logout', 'InicioController@cerrarSesion');

// rutas para recetas
Route::get('/recetas', 'RecetasController@inicio');
Route::post('/recetas/nuevo', 'RecetasController@anadirReceta');
Route::get('/recetas/busca/{idReceta}', 'RecetasController@buscaReceta');
Route::get('/recetas/eliminar/{idReceta}', 'RecetasController@eliminarReceta');

//rutas para ingredientes
Route::get('/ingredientes', 'IngredientesController@inicio');
Route::get('/ingredientes/reportes', 'IngredientesController@reportes');
Route::post('/ingredientes/posicion', 'IngredientesController@updatePos');
Route::post('/ingredientes/posicion/eliminar', 'IngredientesController@deletePos');
Route::post('/ingredientes/nuevo', 'IngredientesController@updateIngrediente');
Route::post('/ingredientes/eliminar', 'IngredientesController@eliminarIngrediente');
Route::get('/ingredientes/{categoria}', 'IngredientesController@ingredienteCategoria');
Route::post('/ingredientes/descuenta', 'IngredientesController@descuentaIngredientes');
Route::post('/ingredientes/asignaPosiciones', 'IngredientesController@asignaPosiciones');
Route::post('/ingredientes/validaPreparacionBebida', 'IngredientesController@validaPreparacionBebida');

//rutas para categorias
Route::get('/categorias', 'CategoriasController@inicio');
Route::post('/categorias/nuevo', 'CategoriasController@anadirCategoria');
Route::post('/categorias/actualizar', 'CategoriasController@actualizarCategoria');
 

//rutas para ventas
Route::get('/ventas', 'VentasController@index');
Route::post('/ventas', 'VentasController@store');


//rutas para bebidas vendidas
Route::get('/bebidas', 'BebidasController@index');
Route::get('/bebidas/latest', 'BebidasController@getLast');
Route::get('/bebidas/{id}', 'BebidasController@show');


//rutas para eventos
Route::get('/eventos', 'EventosController@index');
Route::post('/eventos', 'EventosController@store');
Route::get('/eventos/{id}', 'EventosController@show');
Route::get('/eventos/origen/{origen}', 'EventosController@showByOrigen');
