<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recetas;
use App\Models\RecetaIngrediente;
use App\Models\Ingredientes;
use App\Models\Ventas;


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
            $ingre = new RecetaIngrediente;
            $ingre->idReceta = $id;
            $ingre->idIngrediente = $key;
            $ingre->cantidad = $val;
            $ingre->save();
        }
        
        $ingredientes = RecetaIngrediente::where('idReceta','=',$id)->join('ingredientes', 'ingredientes.idIngrediente','=','recetaIngrediente.idIngrediente')->select('ingredientes.marca')->get();

        $data = array(
            "ingredientes" => $ingredientes,
            "receta" => $id
        );

        return response()->json($data);
    }

    //Descuenta los ingredintes de una receta precreada
    public function descuentaIngredientes(Request $request){
        $sobrante = [];
        for($i=0; $i<count($request->bebidas); $i++){
            foreach( $request->bebidas[$i] as $key => $val) {
                $id = $val; //id de receta
                $listaIngredientes = RecetaIngrediente::where('idReceta','=',$id)->select('idIngrediente','cantidad')->get();
                foreach($listaIngredientes as $lista){
                    $descuento = 0;
                    $ing = Ingredientes::find($lista->idIngrediente);
                    $descuento = $ing->cantidad - $lista->cantidad;
                    $ing->cantidad = $descuento;
                    $sobrante[] = array(
                        $ing->marca => $descuento
                    );
                    $ing->save(); 
                    //validar si queda poca cantidad
                }
                $receta = Recetas::find($id);
                $fecha = date_create();
                $venta = new Ventas;
                $venta->idReceta = $id;
                $venta->precio = $receta->precio;
                $venta->fecha = date('d/m/Y');
                $venta->hora = date_format($fecha, 'H:i:s');
                $venta->save();
            break;
            }
        }
        $msj = array(
            "mensaje" => "Se descontaron los ingredientes"
        );
        return response()->json($msj);
    }

    public function descuentaIngredientesPersonalizado(Request $request){
        $array = json_decode( $request->ingredientes );
        foreach($array as $key => $val) {
            if($val != 0){
                $descuento = 0;
                $ing = Ingredientes::find($key);
                $descuento = $ing->cantidad - $val;
                $ing->cantidad = $descuento;
                $ing->save();
            }    
        }
        $fecha = date_create();
        $venta = new Ventas;
        $venta->idReceta = 1;
        $venta->precio = $request->total;
        $venta->fecha = date('d/m/Y');
        $venta->hora = date_format($fecha, 'H:i:s');
        $venta->save();

        $msj = array(
            "mensaje" => "Se descontaron los ingredientes"
        );
        return response()->json($msj);
    }
}
