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

<<<<<<< HEAD
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

=======
>>>>>>> 0ae6510a6f6006e074868183caed7b5fae2f9298
    
}
