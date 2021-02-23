<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventos = Evento::orderBy('created_at', 'DESC')->get();

        return response()->json($eventos);
    }

    public function infoContains($info, $required_fields)
    {
        foreach($required_fields as $field)
        {
            if(!isset($info[$field]))
                return false;
        }

        return true;
    }

    public function buildInvalidInfoResp($required_fields)
    {
        $msg = "Property info must have ";

        for($i=0; $i < count($required_fields); $i++)
        {
            $msg = $msg . $required_fields[$i];

            if($i + 1 < count($required_fields))
                $msg = $msg . ", ";
        }

        $msg = $msg . ". Event not stored";

        return response($msg, 400);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $evento = new Evento;
        $evento->tipo = $request->tipo;
        $evento->origen = $request->origen;
        $evento->codigo = $request->codigo;

        $info = $request->info;

        // Validate that event has all required info
        switch($request->origen * 100 + $request->codigo)
        {
            // Ingredientes
            case 101:
            case 102:
            case 105:
                if(!$this->infoContains($info, ["marca"]))
                    return $this->buildInvalidInfoResp(["marca"]);
                break;
            case 103:
                if(!$this->infoContains($info, ["marca", "pos", "cantidadPrevia", "cantidadNueva"]))
                    return $this->buildInvalidInfoResp(["marca", "pos", "cantidadPrevia", "cantidadNueva"]);
                break;
            case 104:
                if(!$this->infoContains($info, ["marca", "pos"]))
                    return $this->buildInvalidInfoResp(["marca", "pos"]);
                break;
            // Recetas
            case 201:
            case 202:
                if(!$this->infoContains($info, ["nombre"]))
                    return $this->buildInvalidInfoResp(["nombre"]);
                break;
            // Bebidas entregadas
            case 301:
            case 302:
                if(!$this->infoContains($info, ["bandeja, idVenta"]))
                    return $this->buildInvalidInfoResp(["bandeja, idVenta"]);
                break;
            case 801:
            case 802:
                break;
            case 803:
            case 804:
                if(!$this->infoContains($info, ["usuario"]))
                    return $this->buildInvalidInfoResp(["usuario"]);
                break;
            case 901:
                break;
            default:
                return response("Invalid event. Not stored", 400);
        }

        
        $evento->info = json_encode($info);
        $evento->save();

        return response()->json(['id' => $evento->id], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $evento = Evento::find($id);

        return response()->json($evento);
    }

    public function showByOrigen($origen)
    {
        $eventos = Evento::where('origen', $origen)->latest()->paginate(30);

        return response()->json($eventos);
    }
}
