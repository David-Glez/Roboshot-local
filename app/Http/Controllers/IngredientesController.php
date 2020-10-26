<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Models\Ingredientes;
use App\Models\RecetaIngrediente;
use App\Models\Ventas;
use App\Models\Recetas;
use App\Models\RecetaIngredienteManual;

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
            $nuevoIngrediente->cantidadTotal = $request->cantidad;
            $nuevoIngrediente->cantidadDisponible = $request->cantidad;
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

    // muestra ingrediente por categoria 
    public function ingredienteCategoria($Categoria){
        $ingredientes = Ingredientes::where('idCategoria', '=', $Categoria)->get();

        return response()->json($ingredientes);
    }

    // funcion para descontar ingredientes al solicitar receta
    public function descuentaIngredientes(Request $request){

        //en el caso de que la receta a descontar sea personalizada
        if($request->personalizado == true){
            //decodifica la lista de ingredientes
            $array = json_decode($request->ingredientes);
            $ganancia = 0;

            // se recorre el arreglo de ingredientes
            foreach($array as $key => $val){
                if($val != 0){
                    $descuento = 0;
                    $ing = Ingredientes::where('posicion', $key)->first(); #se busca el ingrediente
                    $descuento = $ing->cantidadDisponible - $val; #se decrementa la cantidad disponible
                    $ing->cantidad = $descuento; #se asigna nueva cantidad disponible
                    $shot = $val/10; #numero de shots
                    $ganancia += ( ($ing->precioVenta - $ing->precioCompra) / ($ing->precioVenta / $ing->precio) ) * $shot  ; #sacamos ( (gananciatotal) / (numero de shot's) * shot's comprados)
                    $ing->save(); #se guardan cambios en la tabla
                }
            }

            // se crea el registro de la venta
            //$fecha = date_create();
            $fecha = Carbon::now();

            $venta = new Ventas;
            $venta->idReceta = 1;
            $venta->precio = $request->total;
            $venta->ganancia = $ganancia;
            $venta->fecha = $fecha->format('d-m-Y');
            $venta->hora = $fecha->format('H:i:s');
            $venta->save();

            $idVenta = $venta->idVenta;

            // insertar ingredientes vendidos de acuerdo al id de venta
            foreach($array as $key => $val){
                if($val != 0){
                    $ingManual = Ingredientes::where('posicion', $key)->first(); #se busca el ingrediente
                    $recetaManual = new recetaIngredienteManual;
                    $recetaManual->codPedido = $idVenta;
                    $recetaManual->idIngrediente = $ingManual->idIngrediente;
                    $recetaManual->cantidad = $val;
                    $recetaManual->save();
                }
            }
        }else{
            for($i=0; $i<count($request->bebidas); $i++){
                foreach( $request->bebidas[$i] as $key => $val) {
                    $id = $val; //id de receta
                    $listaIngredientes = RecetaIngrediente::where('idReceta','=',$id)->select('idIngrediente','cantidad')->get();
                    $ganancia = 0;
                    foreach($listaIngredientes as $lista){
                        $descuento = 0;
                        $ing = Ingredientes::find($lista->idIngrediente);
                        $descuento = $ing->cantidad - $lista->cantidad;
                        $ing->cantidad = $descuento;
                        $ganancia += ( ($ing->precioVenta - $ing->precioCompra) / ($ing->precioVenta / $ing->precio) )* ($lista->cantidad / 10); #sacamos ( (gananciatotal) / (numero de shot's) * shot's comprados)
                        $ing->save(); 
                        //validar si queda poca cantidad
                    }
                    $receta = Recetas::find($id);
                    //$fecha = date_create();
                    $fecha = Carbon::now();
                    $venta = new Ventas;
                    $venta->idReceta = $id;
                    $venta->precio = $receta->precio;
                    $venta->ganancia = $ganancia;
                    $venta->fecha = $fecha->format('d-m-Y');
                    $venta->hora = $fecha->format('H:i:s');
                    $venta->save();
                break;
                }
            }
        }
    }

}
