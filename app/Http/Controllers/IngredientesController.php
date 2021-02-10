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

use Illuminate\Validation\ValidationException;

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

    //  añade o modifica un ingrediente
    public function updateIngrediente(Request $request){
        try{
            $request->validate([
                'id' =>  ['required'],
                'nombre' => ['required'],
                'cantidad' => ['required'],
                'precioCompra' => ['required'],
                'precioVenta' => ['required'],
                'precioMl' => ['required'],
                'categoria' => ['required']
            ]);

            $ingrediente = Ingredientes::find($request->id);
            if($ingrediente == null){

                $newIng = new Ingredientes;
                $newIng->idCategoria = $request->categoria;
                $newIng->marca = $request->nombre;
                $newIng->precio = $request->precioMl;
                $newIng->cantidadTotal = $request->cantidad;
                $newIng->precioCompra = $request->precioCompra;
                $newIng->precioVenta = $request->precioVenta;
                $newIng->save();

                $data = array(
                    'status' => true,
                    'mensaje' => 'Ingrediente insertado',
                    'data' => $newIng,
                );
            }else{
                $ingrediente->marca = $request->nombre;
                $ingrediente->precio = $request->precioMl;
                $ingrediente->cantidadTotal = $request->cantidad;
                $ingrediente->precioCompra = $request->precioCompra;
                $ingrediente->precioVenta = $request->precioVenta;
                $ingrediente->save();

                $data = array(
                    'status' => true,
                    'mensaje' => 'Ingrediente actualizado',
                    'data' => $ingrediente,
                );
            }
        }catch(ValidationException $e){
            $errors = [];
            foreach($e->errors() as $item) {
                foreach($item as $x){
                    $errors[] = $x;
                }
            }
            $data = array(
                'status' => false,
                'mensaje' => $errors,
            );
                return $data;
        }
        return response()->json($data);
    }

    //  elimina un ingrediente siempre y cuando no exista en alguna posicion
    public function eliminarIngrediente(Request $request){

        $id = $request->id;
        $busca = IngredientePosicion::where('idIngrediente', $id)->count();

        if($busca > 0){
            $data = array(
                'status' => false,
                'mensaje' => 'El ingrediente existe en la posicion '
            );
        }else{

            $eliminar = Ingredientes::find($id)->delete();
            $data = array(
                'status' => true,
                'mensaje' => 'Ingrediente eliminado',
                'data' => $id
            );
        }
        return response()->json($data);
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

                foreach($ing_req['posiciones'] as $pos){
                    $ingPos = IngredientePosicion::where("posicion", $pos["posicion"])->first();
                    $ingPos->cantidad = $ingPos->cantidad - $pos["cantidad"]; #se decrementa la cantidad disponible
                    $ingPos->save();
                }

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

    public function validaPreparacionBebida(Request $request)
    {
        $ingredientes_sum = [];

        // sum all ingredients in bebibas we know we can prepare
        if(isset($request->all()["bebidas"]))
            foreach($request->all()["bebidas"] as $bebida)
            {
                foreach($bebida["ingredientes"] as $ing)
                {
                    $ing_found = array_search($ing["idIngrediente"] , array_column($ingredientes_sum, 'idIngrediente'));
                    if($ing_found !== false)
                        $ingredientes_sum[$ing_found]["cantidad"] += $ing["cantidad"];  
                    else
                        $ingredientes_sum[] = ["cantidad" => $ing["cantidad"], "idIngrediente" => $ing["idIngrediente"]];
                }    
            }

        // add to that the new bebida ingredients we want to prepare
        foreach($request->all()["newBebida"] as $ing)
        {
            $ing_found = array_search($ing["idIngrediente"] , array_column($ingredientes_sum, 'idIngrediente'));
            if($ing_found !== false)
                $ingredientes_sum[$ing_found]["cantidad"] += $ing["cantidad"];  
            else
                $ingredientes_sum[] = ["cantidad" => $ing["cantidad"], "idIngrediente" => $ing["idIngrediente"]];
        }    


        // then check if we have enough ingredients to prepare the order
        $canBePrepared = true;

        $allIngredients = Ingredientes::all();

        foreach($ingredientes_sum as $ing_sum)
        {
            $cantidad = $allIngredients->find($ing_sum["idIngrediente"])->cantidad;
            
            // if we have less of any inrgedient than the total amount requested, we can't make the order with the newly added bebida
            if($cantidad < $ing_sum["cantidad"])
            {
                $canBePrepared = false;
                break;
            }
        }

        return response()->json(["canBePrepared" => $canBePrepared]);
    }

    public function asignaPosicionesIngrediente($ing, $allIngPositions)
    {
        $ingPositions = $allIngPositions->where('idIngrediente', $ing["idIngrediente"]);
        $cantidadServir = $ing["cantidad"];

        $ing["posiciones"] = [];

        foreach($ingPositions as $ingPos)
        {
            // ingPos is empty, move on to the next one
            if($ingPos->cantidad <= 0)
                continue;

            // there's enough ingredient in a single ingPos, we're done
            if($ingPos->cantidad >= $cantidadServir)
            {
                $ing["posiciones"][] = array('posicion' => $ingPos->posicion, 'cantidad' => $cantidadServir);
                $ingPos->cantidad -= $cantidadServir;
                $cantidadServir = 0;

                break;
            }

            // there's not enough ingredient here, we gotta visit multiple positions
            // squeeze as much as possible outta this ingredientePosicion
            $ing["posiciones"][] = array('posicion' => $ingPos->posicion, 'cantidad' => $ingPos->cantidad);
            $cantidadServir -= $ingPos->cantidad;
            $ingPos->cantidad = 0;
        }

        return $ing;
    }

    public function asignaPosiciones(Request $request)
    {
        $ingPositions = IngredientePosicion::select('idIngrediente', 'posicion', 'cantidad')->get();

        $bebidas = [];

        foreach($request->all() as $bebida)
        {
            $i = 0;
            foreach($bebida["ingredientes"] as $ing)
            {
                $ingWithPos = $this->asignaPosicionesIngrediente($ing, $ingPositions);
                $bebida["ingredientes"][$i] = $ingWithPos;
                $i++;
            }

            $bebidas[] = $bebida;
        }

        return response()->json($bebidas);

    }
}
