<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
class CategoriasController extends Controller
{
    //Trae todas las categorias registradas en la base de datos
    public function inicio(){
        $categorias = Categorias::all();

        return response()->json($categorias);
    }
}
