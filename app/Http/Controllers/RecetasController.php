<?php

namespace App\Http\Controllers;

use App\Models\Ingredientes;
use Illuminate\Http\Request;
use App\Models\Recetas;
use App\Models\RecetaIngrediente;
use App\Models\RecetaIngredienteManual;

class RecetasController extends Controller
{
    //trae las recetas de la base de datos
    public function inicio(){

        $recetas = Recetas::where('idReceta', '>', 1)->get();
        $card = [];

        foreach($recetas as $val){
            $list = [];
            $ingredientes = RecetaIngrediente::where('idReceta','=',$val->idReceta)->join('ingredientes', 'ingredientes.idIngrediente','=','recetaIngrediente.idIngrediente')->select('ingredientes.marca')->get();
            $cadena="";
            $idIngr = RecetaIngrediente::where('idReceta', $val->idReceta)->get();
            
            foreach($idIngr as $i){
                $pos = Ingredientes::find($i->idIngrediente);
                $dato = array(
                    "idIngrediente" => $pos->idIngrediente,
                    "marca" => $pos->marca, 
                    "cantidad" => $i->cantidad
                );
                $list[] = $dato;
            }

            foreach($ingredientes as $i){
                $cadena .= $i->marca.', '; 
            }
            $cadena = trim($cadena, ', ');
            $data = array(
                "idReceta" => $val->idReceta,
                "nombre"   => $val->nombre,
                "descripcion" => $val->descripcion,
                "precio"   => $val->precio,
                "imagen"   => $val->img,
                "ingredientes" => $cadena,
                "idIngr" => $list,
                "activa" => $val->activa,
                "mezclar" => $val->mezclar
            );
            $card[] = $data;
        }

        return response()->json($card);
    }

    /***** Inserta una nueva receta en la BD*****/
    public function anadirReceta(Request $request){
        //return response()->json($request);
        //$array = json_decode( $request->ingredientes );
        /*foreach($array as $key => $val) {
            echo "<script>console.log( 'Debug Objects: " . $val . "' );</script>";
        }*/
       if($request->imagen == null){
           $verificaIMG = '/img/camera.jpg';
       }else{
           $verificaIMG = $request->imagen;
       }
        $receta = new Recetas;
        $receta->nombre = $request->nombre;
        $receta->precio = $request->precio;
        $receta->descripcion = $request->descripcion;
        $receta->img = $verificaIMG;
        $receta->activa = true;
        $receta->mezclar = $request->mezclar;
        $receta->save();

        $id = $receta->idReceta;

        foreach($request->ingredientes as $ing_req)
        {
            $ing = new RecetaIngrediente;
            $ing->idReceta = $id;
            $ing->idIngrediente = $ing_req["idIngrediente"];
            $ing->cantidad = $ing_req["cantidad"];
            $ing->save();

            $dato = array(
                "idIngrediente" => $ing_req["idIngrediente"],
                "marca" => $ing_req["marca"], 
                "cantidad" => $ing_req["cantidad"]
            );
        }

        $ingredientes = RecetaIngrediente::where('idReceta','=',$id)->join('ingredientes', 'ingredientes.idIngrediente','=','recetaIngrediente.idIngrediente')->select('ingredientes.marca')->get();

        $data = array(
            "ingredientes" => $ingredientes,
            "receta" => $id,
            "idIng" => $request->ingredientes
        );

        return response()->json($data);
    }

    public function eliminarReceta($idReceta){
        $eliminar = Recetas::where('idReceta',$idReceta)->delete();

        return response()->json($eliminar);
    }
}
