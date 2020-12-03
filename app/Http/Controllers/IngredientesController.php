<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Models\Ingredientes;
use App\Models\RecetaIngrediente;
use App\Models\Venta;
use App\Models\Recetas;
use App\Models\RecetaIngredienteManual;
use App\Models\IngredienteVendido;
use App\Models\BebidaVendida;
use App\Models\Categorias;

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
            $nuevoIngrediente->precioCompra = $request->precioCompra;
            $nuevoIngrediente->precioVenta = $request->precioVenta;
            $nuevoIngrediente->save();
            $id = $nuevoIngrediente->idIngrediente;

            $ingrediente = array(
                'nuevo' => true,
                'id' => $id,
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
        $ingredientes = Ingredientes::where('idCategoria', '=', $Categoria)->where('idIngrediente','!=', 10)->where('idIngrediente','!=', 11)->get();

        return response()->json($ingredientes);
    }

    // crea un registro en la tabla de un ingrediente vendido, con el id de la venta y los datos del ingrediente
    // tambien calcula la ganancia de la venta
    public function creaRegistroIngredienteVendido($idVenta, $ing_data, $cantidad)
    {
        $venta = Venta::find($idVenta);

        $ing_vendido = new IngredienteVendido;
        
        $ing_vendido->idVenta = $idVenta;

        $ing_vendido->idIngrediente = $ing_data->idIngrediente;
        $ing_vendido->precioCompra = $ing_data->precioCompra;
        $ing_vendido->precioVenta = $ing_data->precioVenta;
        $ing_vendido->cantidad = $cantidad;
        $ing_vendido->fecha = $venta->fecha;

        $categoria = Categorias::find($ing_data->idCategoria)->nombre;

        $ing_vendido->nombre = "[" . $categoria . "] " . $ing_data->marca;

        $ing_vendido->save();


        // calcular la ganancia de la venta. una venta nueva tiene su ganancia en 0
        // la cantidad esta en ml y precioCompra/precioVenta en L

        $venta->ganancia += ($ing_vendido->precioVenta - $ing_vendido->precioCompra) / 1000.0 * $ing_vendido->cantidad;

        $venta->save();
    }

    public function creaRegistroBebidaVendida($idVenta, $nombreBebida)
    {
        $bebida_vendida = new BebidaVendida;

        $bebida_vendida->idVenta = $idVenta;
        $bebida_vendida->nombre = $nombreBebida;

        $bebida_vendida->save();
    }

    // funcion para descontar ingredientes al solicitar receta
    public function descuentaIngredientes(Request $request){

        $contador = 0;
        $porcentaje = 0;
        $ingredientes = [];
        $color = '';
        $inactivas = [];

        for($i = 0; $i < count($request->bebidas); $i++){
            foreach($request->bebidas[$i]["ingredientes"] as $key => $val){
                $descuento = 0;
                $ing = Ingredientes::where('posicion', $key)->first(); #se busca el ingrediente
                $descuento = $ing->cantidadDisponible - $val; #se decrementa la cantidad disponible
                $ing->cantidadDisponible = $descuento; #se asigna nueva cantidad disponible
                $porcentaje = ($descuento * 100) / $ing->cantidadTotal; #se saca el porcentaje para ver que ingredientes se estan agotando
                #verificamos en que nivel se encuentra el ingrediente
                if($porcentaje >= 20 && $porcentaje <= 30){
                    $contador++;
                    $color = 'yellow';
                } elseif($porcentaje >= 7 && $porcentaje < 20) {
                    $contador++;
                    $color = 'red';
                } elseif($porcentaje < 7){ #limite para desactivar las recetas 
                    $color = 'black';
                    $contador++;
                    $recetas = Recetas::join('recetaIngrediente','recetas.idReceta','recetaIngrediente.idReceta')->where('recetaIngrediente.idIngrediente',$ing->idIngrediente)->where('recetas.activa',true)->select('recetas.idReceta','recetas.activa')->get();
                    foreach($recetas as $r){
                        $inactivas[] = $r->idReceta;
                        $r->activa = false;
                        $r->save();
                    }
                }
                $ing->save(); #se guardan cambios en la tabla

                // Crea registro ingrediente vendido
                // folio = id, ing = ingrediente en memoria leido de la base, val = cantidad a descontar
                $this->creaRegistroIngredienteVendido($request->numOrden, $ing, $val);
            }
            $this->creaRegistroBebidaVendida($request->numOrden, $request->bebidas[$i]->nombre);
        }

        //en el caso de que la receta a descontar sea personalizada
        /*if($request->personalizado == true){
            //decodifica la lista de ingredientes
            $array = json_decode($request->bebidas);
            $ganancia = 0;

            // se recorre el arreglo de ingredientes
            foreach($array as $key => $val){
                if($val != 0){
                    $descuento = 0;
                    $ing = Ingredientes::where('posicion', $key)->first(); #se busca el ingrediente
                    $descuento = $ing->cantidadDisponible - $val; #se decrementa la cantidad disponible
                    $ing->cantidadDisponible = $descuento; #se asigna nueva cantidad disponible
                    $shot = $val/10; #numero de shots
                    $ganancia += ( ($ing->precioVenta - $ing->precioCompra) / ($ing->precioVenta / $ing->precio) ) * $shot  ; #sacamos ( (gananciatotal) / (numero de shot's) * shot's comprados)
                    $porcentaje = ($descuento * 100) / $ing->cantidadTotal;
                    if($porcentaje < 50){
                        $contador++;
                    }
                    $ing->save(); #se guardan cambios en la tabla

                    //$this->creaRegistroIngredienteVendido($request->folio, $ing, $val); // val = cantidad descontada del shot???
                    $data = array(
                        'posicion' => $key,
                        'cantidad' => $val
                    );
                    $ingredientes[] = $data;
                }
            }

            // se crea el registro de la venta
            //$fecha = date_create();
            /*$fecha = Carbon::now();

            $venta = new Ventas;
            $venta->idReceta = 1;
            $venta->precio = $request->total;
            $venta->ganancia = $ganancia;
            $venta->fecha = $fecha->format('d-m-Y');
            $venta->hora = $fecha->format('H:i:s');
            $venta->save();

            $ingredientes[] = $array;
            $idVenta = $venta->idVenta;

            // insertar ingredientes vendidos de acuerdo al id de venta
            /*foreach($array as $key => $val){
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
                   // $ingredientes[] = $listaIngredientes;
                    $ganancia = 0;
                    foreach($listaIngredientes as $lista){
                        $descuento = 0;
                        $ing = Ingredientes::find($lista->idIngrediente);
                        $descuento = $ing->cantidadDisponible - $lista->cantidad;
                        $ing->cantidadDisponible = $descuento;
                        $ganancia += ( ($ing->precioVenta - $ing->precioCompra) / ($ing->precioVenta / $ing->precio) )* ($lista->cantidad / 10); #sacamos ( (gananciatotal) / (numero de shot's) * shot's comprados)
                        //verificar si queda liquido disponible
                        $porcentaje = ($descuento * 100) / $ing->cantidadTotal;
                        if($porcentaje < 50){
                            $contador++;
                        }
                        $ing->save(); 
                        
                        $this->creaRegistroIngredienteVendido($request->folio, $ing, $lista->cantidad);

                        $data = array(
                            'posicion' => $ing->posicion,
                            'cantidad' => $lista->cantidad
                        );
                        $ingredientes[] = $data;
                    }
                    /*$receta = Recetas::find($id);
                    //$fecha = date_create();
                    /*$fecha = Carbon::now();
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
        }*/

        $data = array(
            'contador' => $contador,
            'color' => $color,
            'inactivas' => $inactivas,
            'lista' => $ingredientes
        );
        return response()->json($data);
    }
}
