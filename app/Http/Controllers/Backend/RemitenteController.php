<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\RemitenteComunicacion;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use App\Models\Remitente;

class RemitenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $remitentes = RemitenteComunicacion::all();

        return view('backend.remitentes_comunicacion.index', compact('remitentes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.remitentes_comunicacion.create');
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

        RemitenteComunicacion::create($request->except('_token'));

        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.remitente.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Remitente  $remitente
     * @return \Illuminate\Http\Response
     */
    public function edit(RemitenteComunicacion $remitente)
    {
        return view('backend.remitentes_comunicacion.edit', compact('remitente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Remitente  $remitente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RemitenteComunicacion $remitente)
    {
        $this->validate($request, [
            'nombre' => 'required',
        ]);

        $remitente->fill($request->except('_token'))->update();

        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.remitente.index');
    }


    public function getRemitentesJson()
    {
        return response()->json(Remitente::all());
    }
}
