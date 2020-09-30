<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
class CategoriasController extends Controller
{
    //Trae todas las categorias registradas en la base de datos
    public function inicio(){
        $Categoria = Categorias::select('idCategoria','nombre')->get();

        return response()->json($Categoria);
    }

    
}
