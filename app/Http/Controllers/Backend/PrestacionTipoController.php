<?php

namespace App\Http\Controllers\Backend;


use App\Models\PrestacionTipo;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;

class PrestacionTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_presentaciones = PrestacionTipo::all();
        return view('backend.tipo_presentaciones.index', compact('tipo_presentaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = new PrestacionTipo();

        return view('backend.tipo_presentaciones.create', compact('tipos'));
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
            'nombre' => 'required'
        ]);

        PrestacionTipo::create($request->except('_token'));


        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.tipo-presentaciones.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PrestacionTipo  $presentacionTipo
     * @return \Illuminate\Http\Response
     */
    public function edit($id, PrestacionTipo $presentacionTipo)
    {
        $tipos = new PrestacionTipo();
        return view('backend.tipo_presentaciones.edit')->with([
            'presentacion_tipo' => $presentacionTipo->findOrFail($id),
            'tipos' => $tipos
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PresentacionTipo  $presentacionTipo
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, PrestacionTipo $presentacionTipo)
    {
        $this->validate($request, [
            'nombre' => 'required'
        ]);

        $presentacion = PrestacionTipo::findOrFail($id);
        $presentacion->fill($request->except('_token'))->update();


        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.tipo-prestacion.index');
    }
}
