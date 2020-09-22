<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recetas;
use App\Models\RecetaIngrediente;


class RecetasController extends Controller
{
    //trae las recetas de la base de datos
    public function inicio(){

        $recetas = Recetas::all();
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
}
