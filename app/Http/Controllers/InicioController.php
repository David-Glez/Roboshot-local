<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use app\Models\User;

class InicioController extends Controller
{
    //Valida las credenciales del usuario al hacer login
    public function inicioSesion(Request $request){

        $validaUsuario = $request->only('nombre', 'password');

        $verificacion = Auth::attempt($validaUsuario);

        if($verificacion){
            $idUsuario = Auth::user()->id;
            $datos = array(
                'idUsuario' => $idUsuario,
                'autorizado' => $verificacion
            );
        }else{
            $datos = array(
                'idUsuario' => 0,
                'autorizado' => $verificacion
            );
        }
    
        return response()->json($datos);
    }

    public function creaUsuario(Request $request){
        DB::table('usuarios')->insert([
            'nombre' => $request->usuario,
            'password' => bcrypt($request->contraseña),
            'idRol' => $request->rol
        ]);
    }
}
