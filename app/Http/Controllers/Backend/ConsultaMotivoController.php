<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Trabajador;
use App\Models\Event;

use App\Models\ConsultaMotivo;
use Illuminate\Http\Request;



use Illuminate\Support\Facades\Session;

class ConsultaMotivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consulta_motivos = ConsultaMotivo::all();

        return view('backend.consulta_motivo.index', compact('consulta_motivos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.consulta_motivo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
        ]);

        ConsultaMotivo::create($request->except('_token'));
        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.consulta-motivo.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ConsultaMotivo  $consultaMotivo
     * @return \Illuminate\Http\Response
     */
    public function edit(ConsultaMotivo $consultaMotivo)
    {
        return view('backend.consulta_motivo.edit', compact('consultaMotivo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConsultaMotivo  $consultaMotivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConsultaMotivo $consultaMotivo)
    {
        $this->validate($request, [
            'nombre' => 'required',
        ]);

        $consultaMotivo->fill($request->except('_token'))->update();

        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.consulta-motivo.index');
    }
}
