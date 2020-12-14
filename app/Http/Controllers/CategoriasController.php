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

    public function anadirCategoria(Request $request){
        $categoria =  new Categorias;
        $categoria->nombre = $request->nombre;
        $categoria->save();

        $datos = array(
            'idCategoria' => $categoria->idCategoria,
            'nombre' => $categoria->nombre
        );

        return response()->json($datos);
    }

    public function actualizarCategoria(Request $request){
        Categorias::find($request->id)->update(['nombre' => $request->nombre]);
        
        return response()->json(true);
    }

    
}
