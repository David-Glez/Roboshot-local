<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recetas;
use App\Models\RecetaIngrediente;
use App\Models\Ingredientes;


class RecetasController extends Controller
{
    //trae las recetas de la base de datos
    public function inicio(){

        $recetas = Recetas::where('activa','=', true)->get();
        $card = [];

        foreach($recetas as $val){
            $ingredientes = RecetaIngrediente::where('idReceta','=',$val->idReceta)->join('ingredientes', 'ingredientes.idIngrediente','=','recetaIngrediente.idIngrediente')->select('ingredientes.marca')->get();
            $cadena="";
            foreach($ingredientes as $i){
                $cadena .= $i->marca.', '; 
            }
            $data = array(
                "idReceta" => $val->idReceta,
                "nombre"   => $val->nombre,
                "descripcion" => $val->descripcion,
                "precio"   => $val->precio,
                "imagen"   => $val->img,
                "ingredientes" => $cadena
            );
            $card[] = $data;
        }

        return response()->json($card);
    }

    public function prueba(){
        
    }

    /***** Inserta una nueva receta en la BD*****/
    public function anadirReceta(Request $request){
        $array = json_decode( $request->ingredientes );
        /*foreach($array as $key => $val) {
            echo "<script>console.log( 'Debug Objects: " . $val . "' );</script>";
        }*/
       
        $receta = new Recetas;
        $receta->nombre = $request->nombre;
        $receta->precio = $request->precio;
        $receta->descripcion = $request->descripcion;
        $receta->img = $request->imagen;
        $receta->activa = true;
        $receta->save();

        $id = $receta->idReceta;

        //$array = $request->ingredientes;
        foreach($array as $key => $val) {
            if($val != 0){
                $ingre = new RecetaIngrediente;
                $ingre->idReceta = $id;
                $ingre->idIngrediente = $key;
                $ingre->cantidad = $val;
                $ingre->save();
            }
        }
        
        $ingredientes = RecetaIngrediente::where('idReceta','=',$id)->join('ingredientes', 'ingredientes.idIngrediente','=','recetaIngrediente.idIngrediente')->select('ingredientes.marca')->get();

        $data = array(
            "ingredientes" => $ingredientes,
            "receta" => $id
        );

        return response()->json($data);
    }

    
}
