<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\ConsultaTipo;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class ConsultaTipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consulta_tipos = ConsultaTipo::all();

        return view('backend.consulta_tipo.index', compact('consulta_tipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.consulta_tipo.create');
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

        ConsultaTipo::create($request->except('_token'));

        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.consulta-tipo.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ConsultaTipo  $consultaTipo
     * @return \Illuminate\Http\Response
     */
    public function edit(ConsultaTipo $consultaTipo)
    {
        return view('backend.consulta_tipo.edit', compact('consultaTipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConsultaTipo  $consultaTipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConsultaTipo $consultaTipo)
    {
        $this->validate($request, [
            'nombre' => 'required'
        ]);

        $consultaTipo->fill($request->except('_token'))->update();
        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.consulta-tipo.index');

    }
}
