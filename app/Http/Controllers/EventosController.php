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
        $eventos = Evento::all();

        return response()->json($eventos);
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
        $evento->info = json_encode($request->info);
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
