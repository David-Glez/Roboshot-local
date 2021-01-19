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
                    "posicion" => $pos->posicion,
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
        $array = json_decode( $request->ingredientes );
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
        $p = 0;

        $list = [];
        //$array = $request->ingredientes;
        foreach($array as $key => $val) {
            if($val != 0){
                
                $ingre = new RecetaIngrediente;
                $ingre->idReceta = $id;
                $ingre->idIngrediente = intval($key);
                $ingre->cantidad = intval($val);
                $ingre->save();

                $pos = Ingredientes::find(intval($key));
                $dato = array(
                    "idIngrediente" => $pos->idIngrediente,
                    "marca" => $pos->marca, 
                    "posicion" => $pos->posicion,
                    "cantidad" => intval($val)
                );
                $list[] = $dato;
            }
        }

        $ingredientes = RecetaIngrediente::where('idReceta','=',$id)->join('ingredientes', 'ingredientes.idIngrediente','=','recetaIngrediente.idIngrediente')->select('ingredientes.marca')->get();

        $data = array(
            "ingredientes" => $ingredientes,
            "receta" => $id,
            "idIng" => $list
        );

        return response()->json($data);
    }

    public function eliminarReceta($idReceta){
        $eliminar = Recetas::where('idReceta',$idReceta)->delete();

        return response()->json($eliminar);
    }
}
