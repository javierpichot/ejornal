<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\ComunicacionTipo;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class ComunicacionTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_comunicaciones = ComunicacionTipo::all();

        return view('backend.tipo_comunicaciones.index', compact('tipo_comunicaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tipo_comunicaciones.create');
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

        ComunicacionTipo::create($request->except('_token'));

        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.comunicacion-tipo.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComunicacionTipo  $comunicacionTipo
     * @return \Illuminate\Http\Response
     */
    public function edit(ComunicacionTipo $comunicacionTipo)
    {
        return view('backend.tipo_comunicaciones.edit', compact('comunicacionTipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComunicacionTipo  $comunicacionTipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComunicacionTipo $comunicacionTipo)
    {
        $this->validate($request, [
            'nombre' => 'required',
        ]);

        $comunicacionTipo->fill($request->except('_token'))->update();

        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.comunicacion-tipo.index');
    }
}
