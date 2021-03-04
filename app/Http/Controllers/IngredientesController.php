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

    public function reportes()
    {
        $ingredientes = Ingredientes::all();

        $response = [];
        foreach($ingredientes as $ing)
        {
            $response[] = [
                'idIngrediente' => $ing->idIngrediente,
                'marca' => $ing->marca,
                'categoria' => Categorias::find($ing->idCategoria)->nombre,
                'cantidad' => $ing->cantidad,
                'precioCompra' => $ing->precioCompra,
                'precioVenta' => $ing->precioVenta
            ];
        }

        return response()->json($response);
    }

    //  actualiza la posicion con el ingrediente enviado
    public function updatePos(Request $request){
        $id = $request->idIngrediente;
        $pos = $request->posicion;
        
        $posicion = IngredientePosicion::updateOrCreate(
            ['posicion' => $pos, 'idIngrediente' => $id],
            [
                'cantidad' => $request->cantidad,
                'cantidadTotal' => $request->total
            ]
        );

        $ingredientQuantity = Ingredientes::find($id);

        $activas = $this->activaReceta();
        $data = array(
            'status' => true,
            'disponible' => $posicion->cantidad,
            'mensaje' => 'Posición actualizada',
            'ing_quantity' => $ingredientQuantity->cantidad,
            'activas' => $activas
        );
        
        return response()->json($data);
    }

    /**
     * Revisa los ingredientes de las rectas y compara la cantidad total que existe del ingrediente con la cantidad que requiere la receta.
     * Si confirma que se puede despachar, activa la receta, de lo contrario la sigue dejando inactiva
     * @return Array $activas: almacena las recetas que se activaron para mandarselas al HMI. 
     */
    public function activaReceta(){
        $activas = [];
        $bandera = false;
        $recetas = Recetas::where('activa',false)->where('idReceta','!=',1)->select('idReceta','activa')->get();
        if(count($recetas) > 0){
            foreach($recetas as $r){
                $ingredientes = RecetaIngrediente::where('idReceta',$r->idReceta)->select('idIngrediente','cantidad')->get();
                foreach($ingredientes as $i){
                    $bandera = false;
                    $ingrediente = Ingredientes::find($i->idIngrediente);
                    if($ingrediente->cantidad >= $i->cantidad){
                        $bandera = true;
                    }
                }
                if($bandera){
                    $activas[] = $r->idReceta;
                }
                $r->activa = $bandera;
                $r->save();
                
            }
        }

        return $activas ;
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
                'precioCompra' => ['required'],
                'precioVenta' => ['required'],
                'categoria' => ['required']
            ]);
            $ingredient = Ingredientes::updateOrCreate(
                ['idIngrediente' => $request->id],
                [
                    'idCategoria' => $request->categoria,
                    'marca' => $request->nombre,
                    'precioCompra' => $request->precioCompra,
                    'precioVenta' => $request->precioVenta
                ]
            );

            $data = array(
                'status' => true,
                'mensaje' => 'Ingrediente actualizado',
                'data' => $ingredient,
            );
            
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
    public function creaRegistroIngredienteVendido($idVenta, $idBebida, $ing_data, $cantidad)
    {
        $venta = Venta::find($idVenta);

        $ing_vendido = new IngredienteVendido;
        
        $ing_vendido->idVenta = $idVenta;
        $ing_vendido->idBebida = $idBebida;

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

        return $bebida_vendida->id;
    }
    
    /**
     * Recibe el Json de la orden con los ingredientes y descuenta la cantidad utilizada del ingrediente en sus
     * respectivas posiciones, verifica su cantidad restante y desactiva las recetas que ya no puedan ser servidas
     * @param JSON $orden JSON que contiene las bebidas e ingredientes a descontar
     * @return Array $data arreglo con el contador y las bebidas que fueron desactivadas
     */
    public function descuentaIngredientes(Request $request){
        $contador = 0;
        $porcentaje = 0;
        $color = '';
        $inactivas = [];

        foreach($request->bebidas as $bebida){
            $bebida["id"] = $this->creaRegistroBebidaVendida($request->numOrden, $bebida["nombre"]);
            
            foreach($bebida["ingredientes"] as $ing_req){
                $ing = Ingredientes::find($ing_req["idIngrediente"]);
                foreach($ing_req['posiciones'] as $arrPosiciones){
                    $ingPos = IngredientePosicion::where("posicion", $arrPosiciones["posicion"])->first();
                    $ingPos->cantidad = $ingPos->cantidad - $arrPosiciones["cantidad"]; #se decrementa la cantidad disponible
                    $ingPos->save();
                    $porcentaje = $this->calculaPorcentaje($ing->idIngrediente);
                  
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
                    
                }    

                // Crea registro ingrediente vendido
                // idVenta = id orden, ing_data = ingrediente en memoria leido de la base, cantidad = cantidad a descontar
                $this->creaRegistroIngredienteVendido($request->numOrden, $bebida["id"], $ing, $ing_req["cantidad"]);
            }
        }

        $ingredientes = Ingredientes::with('ingPos')->get();
        $response = array(
            'contador' => $contador,
            'color' => $color,
            'inactivas' => $inactivas,
            'ingredientes_pos' => $ingredientes
        );
        
        return response()->json($response);
    } 

    /**
	 * Calcula el porcentaje total restante del ingrediente
	 *
	 * @param Int $idIngrediente  identificador del ingrediente
	 * @return Int $porcentaje  porcentaje restante del ingrediente
	 */
    public function calculaPorcentaje($idIngrediente){
        #sumatoria de la cantidad disponible del ingrediente en todas sus posiciones
        $canDisponible = IngredientePosicion::where('idIngrediente',$idIngrediente)->sum('cantidad');
        #sumatoria de la cantidad total del ingredinte en todas sus posiciones
        $canTotal = IngredientePosicion::where('idIngrediente',$idIngrediente)->sum('cantidadTotal');

        $porcentaje = ($canDisponible / $canTotal) * 100;

        return $porcentaje;
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
