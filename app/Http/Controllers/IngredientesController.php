<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ingredientes;
use App\Models\IngredientePosicion;
use App\Models\RecetaIngrediente;
use App\Models\Venta;
use App\Models\Recetas;
use App\Models\RecetaIngredienteManual;
use App\Models\IngredienteVendido;
use App\Models\BebidaVendida;
use App\Models\Categorias;
use Illuminate\Database\Eloquent\Builder;

class IngredientesController extends Controller
{
    //Trae todos los ingredientes registrados en la base de datos
    public function inicio(){

        //$ingredientes = Ingredientes:all();
        $ingredientes = Ingredientes::with('ingPos')->get();

        return response()->json($ingredientes);
    }

    //  actualiza la posicion con el ingrediente enviado
    public function updatePos(Request $request){
        $id = $request->id;
        $pos = $request->posicion;
        $posicion = IngredientePosicion::where('idIngrediente',$id)->where('posicion', $pos)->first();
        if($posicion){
            $posicion->cantidad = $request->cantidad;
            $posicion->save();
            $data = array(
                'status' => true,
                'actualizado' => true,
                'disponible' => $request->cantidad,
                'mensaje' => 'Posición actualizada'
            );
        }else{
            $newPos = new IngredientePosicion;
            $newPos->idIngrediente = $request->idIngrediente;
            $newPos->posicion = $request->posicion;
            $newPos->cantidad = $request->cantidad;
            $newPos->save();
            $data = array(
                'status' => true,
                'actualizado' => false,
                'disponible' => $request->cantidad,
                'mensaje' => 'Posición añadida'
            );

        }
        return response()->json($data);
    }

    //  elimina una posicion
    public function deletePos(Request $request){

        //  se elimina de la tabla
        $pos = IngredientePosicion::where('posicion', $request->posicion)->delete();
        if($pos){
            $data = array(
                'status' => true,
                'mensaje' => 'Posición eliminada',
            );
        }else{
            $data = array(
                'status' => false,
                'mensaje' => 'Falla al eliminar',
            );
        }
        
        return response()->json($data);
    }

    //  Añade un nuevo ingrediente
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
        //$ingredientes = Ingredientes::where('idCategoria', '=', $Categoria)->where('idIngrediente','!=', 10)->where('idIngrediente','!=', 11)->get();

        $ingredientes = Ingredientes::where('idCategoria', '=', $Categoria)->get();

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

        foreach($request->bebidas as $bebida){
            foreach($bebida["ingredientes"] as $ing_req){
                $ing = Ingredientes::find($ing_req["idIngrediente"]);
                $ingPos = IngredientePosicion::where("posicion", $ing_req["posicion"])->first();

                $ingPos->cantidad = $ingPos->cantidad - $ing_req["cantidad"]; #se decrementa la cantidad disponible

                if($ingPos->cantidad <= 0)
                    $porcentaje = 0;
                else
                    $porcentaje = $ingPos->cantidad / $ing->cantidadTotal * 100.0; #se saca el porcentaje para ver que ingredientes se estan agotando

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
                $ingPos->save();

                // Crea registro ingrediente vendido
                // folio = id, ing = ingrediente en memoria leido de la base, val = cantidad a descontar
                $this->creaRegistroIngredienteVendido($request->numOrden, $ing, $ing_req["cantidad"]);
            }
            //$this->creaRegistroBebidaVendida($request->numOrden, $request->bebidas[$i]["nombre"]);
            $this->creaRegistroBebidaVendida($request->numOrden, $bebida["nombre"]);
        }

        $data = array(
            'contador' => $contador,
            'color' => $color,
            'inactivas' => $inactivas,
            'lista' => $ingredientes
        );
        return response()->json($data);
    }
}
