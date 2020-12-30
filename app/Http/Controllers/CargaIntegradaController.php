<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ausentismo;
use App\Models\Comunicacion;

class CargaIntegradaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Guardar en base el Ausentismo
        $ausentismo = new Ausentismo();
        $ausentismo->fecha_ausente = $request->fecha_inicio;
        $ausentismo->empresa_id = $request->id_empresa;
        $ausentismo->trabajador_id = $request->id_trabajador;
        $ausentismo->ausentismo_tipo_id = $request->tipo_ausentismo;
        $ausentismo->consulta_motivo_id = $request->consulta_motivos;
        $ausentismo->fecha_alta = $request->fecha_alta;
        $ausentismo->fecha_probable_alta = $request->fecha_probable_alta;
        $ausentismo->motivo = $request->motivo;
        $ausentismo->user_id = $request->id_usuario;
        $ausentismo->save();

        //Guardar en base la comunicacion
        $comunicacion = new Comunicacion();
        $comunicacion->motivo_comunicacion_id = $request->motivo_comunicaciones;
        $comunicacion->remitente_id = $request->remitentes;
        $comunicacion->contenido = $request->contenido_comunicacion;
        $comunicacion->ausentismo_id = $ausentismo->id;
        $comunicacion->user_id = $request->id_usuario;
        $comunicacion->trabajador_id = $request->id_trabajador;
        $comunicacion->modo_comunicacion_id = $request->modo_comunicaciones;
        $comunicacion->empresa_id = $request->id_empresa;
        $comunicacion->save();

        return back()->with('success', 'Carga integrada realizada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
