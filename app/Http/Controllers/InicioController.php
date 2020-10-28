<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use app\Models\User;
use App\Models\RegistroLog;

class InicioController extends Controller
{
    //Valida las credenciales del usuario al hacer login
    public function inicioSesion(Request $request){

        //  creacion de la fecha
        $date = Carbon::now();

        //  campos de usuario y contraseña
        $validaUsuario = $request->only('nombre', 'password');

        // funcion de verificacion
        $verificacion = Auth::attempt($validaUsuario);

        if($verificacion){
            $idUsuario = Auth::user()->idUsuario;

            //  registro en la tabla registroLog
            $log =  new RegistroLog;
            $log->fecha = $date->format('d-m-Y');
            $log->hora = $date->format('H:i:s');
            $log->operacion = 'Log in';
            $log->descripcion = 'Usuario: '.Auth::user()->nombre;
            $log->save();
            
            $datos = array(
                'idUsuario' => $idUsuario,
                'autorizado' => $verificacion,
                'hora' => $date->format('H:i:s')
            );
        }else{
            $datos = array(
                'idUsuario' => 0,
                'autorizado' => $verificacion,
                'hora' => $date->format('h:i:s')
            );
        }
    
        return response()->json($datos);
    }

    //  funcion para cerrar sesión
    public function cerrarSesion(Request $request){

         //  creacion de la fecha
         $date = Carbon::now();

        //  registro en la tabla registroLog
        $log =  new RegistroLog;
        $log->fecha = $date->format('d-m-Y');
        $log->hora = $date->format('H:i:s');
        $log->operacion = 'Log out';
        $log->descripcion = 'Usuario: '.$request->usuario;
        $log->save();

        //Auth::logout();

        $data = array(
            'logout' => true
        );

        return response()->json($data);

    }
}
