<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ventas;
use App\Models\Venta;


class VentasController extends Controller
{
    ///**Muestra todas las ventas registradas */
    public function index(){
        $ventas = Ventas::join('recetas','ventas.idReceta','recetas.idReceta')->select('ventas.*','recetas.nombre')->get();
        #$sum = Ventas::join('recetas','ventas.idReceta','recetas.idReceta')->sum('recetas.precio');
        $sum = $ventas->sum('precio');
        $data = array(
            "ventas" => $ventas,
            "total" => $sum
        );
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $venta = new Venta;
        $venta->total = $request->total;
        $venta->ganancia = $request->ganancia;
        $venta->fecha = $request->fecha;
        $venta->online = $request->online;
        $venta->save();
    }
}
