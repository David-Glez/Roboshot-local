<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredientes;
use App\Models\RecetaIngrediente;

class IngredientesController extends Controller
{
    //Trae todos los ingredientes registrados en la base de datos
    public function inicio(){
        $ingredientes = Ingredientes::all();

        return response()->json($ingredientes);
    }

    //Añade un nuevo ingrediente
    public function anadirIngrediente(Request $request){
        $busca = Ingredientes::where('posicion', $request->posicion)->count();
        if($busca == 0){
            $nuevoIngrediente = new Ingredientes;
            $nuevoIngrediente->idCategoria = $request->categoria;
            $nuevoIngrediente->marca = $request->marca;
            $nuevoIngrediente->precio = $request->precio;
            $nuevoIngrediente->cantidad = $request->cantidad;
            $nuevoIngrediente->posicion = $request->posicion;
            $nuevoIngrediente->save();

            $ingrediente = array(
                'nuevo' => true,
                'posicion' => $request->posicion
            );
        }else{
            $ingrediente = array(
                'nuevo' => false,
                'posicion' => 'Ya existe esta posición'
            );
        }

        return response()->json($ingrediente);
    }

    //eliminar un ingrediente
    public function eliminarIngrediente(Request $request){

        //verifica que el ingrediente no exista en una receta
        $busca = Ingredientes::where('posicion', $request->posicion)->first();
        
        $recetaIng = RecetaIngrediente::where('idIngrediente', $busca->idIngrediente)->count();

        if($recetaIng > 0){
            $respuesta = array(
                'estado' => false,
                'mensaje' => 'No se puede eliminar el ingrediente. Existe una receta que lo utiliza.'
            );
        }else{
            $elimina = Ingredientes::where('posicion', $request->posicion)->delete();
            $respuesta = array(
                'estado' => true,
                'mensaje' => 'Ingrediente eliminado.'
            );
        }

        return response()->json($respuesta);
    }
    /***** Muestra los ingredientes registrados por Categoria*****/
    public function ingredienteCategoria($Categoria){
        $ingredientes = Ingredientes::where('idCategoria', '=', $Categoria)->get();

        return response()->json($ingredientes);
    }
}
