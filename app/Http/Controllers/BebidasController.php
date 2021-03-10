<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BebidaVendida;

class BebidasController extends Controller
{
    public function index()
    {
        $bebidas = BebidaVendida::all();

        return response()->json($bebidas);
    }

    public function getLast()
    {
        $bebida = BebidaVendida::latest('id')->first();

        if($bebida == null){
            $bebida = ['id' => 0];
        }

        return response()->json($bebida);
    }


    public function show($id)
    {
        $bebida = BebidaVendida::with('ingredientesVendidos:idBebida,idIngrediente,nombre,cantidad')->find($id);

        return response()->json($bebida);
    }

}
