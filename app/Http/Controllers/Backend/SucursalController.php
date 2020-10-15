<?php

namespace App\Http\Controllers\Backend;

use App\Models\Empresa;
use App\Models\Sucursal;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursales = Sucursal::with('empresa')->get();

        return view('backend.sucursal.index', compact('sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = Empresa::all();
        return view('backend.sucursal.create', compact('empresas'));
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
            'nombre' => 'required|unique:sucursals',
            'direccion' => 'required',
            'empresa_id' => 'required',
        ]);

        $empresa = Empresa::findOrFail($request->input('empresa_id'));

        $empresa->sucursal()->create($request->except('_token', 'empresa_id'));

        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.sucursales.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Sucursal $sucursal)
    {
        $empresas = Empresa::all();
        return view('backend.sucursal.edit')->with([
            'sucursal' => $sucursal->findOrFail($id),
            'empresas' => $empresas,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Sucursal $sucursal)
    {
        $sucursal = $sucursal->findOrFail($id);

        $this->validate($request, [
            'nombre' => 'required|unique:sucursals,nombre,' . $sucursal->id,
            'direccion' => 'required',
            'empresa_id' => 'required',
        ]);

        $sucursal->fill($request->except('_token'))->update();
        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.sucursales.index');
    }
}
