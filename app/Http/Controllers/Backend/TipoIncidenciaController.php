<?php

namespace App\Http\Controllers\Backend;

use App\Models\TipoIncidencia;
use Illuminate\Http\Request;
use App\Models\TipoIncidecia;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;

class TipoIncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_incidencias = TipoIncidencia::all();
        return view('backend.tipo_incidencias.index', compact('tipo_incidencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tipo_incidencias.create');
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
            'nombre' => 'required|unique:tipo_incidencias',

        ]);
        TipoIncidencia::create($request->except('_token'));

        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.tipo-incidencias.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoIncidencia  $tipoIncidencia
     * @return \Illuminate\Http\Response
     */
    public function edit($id, TipoIncidencia $tipoIncidencia)
    {
        return view('backend.tipo_incidencias.edit')->with([
            'tipo_incidencias' => $tipoIncidencia->findOrFail($id)
        ]);
    }
}
