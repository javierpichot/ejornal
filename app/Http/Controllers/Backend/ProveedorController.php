<?php

namespace App\Http\Controllers\Backend;

use App\Models\Proveedor;
use App\Models\PrestacionTipo;
use App\Traits\Authorizable;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;

class ProveedorController extends Controller
{
    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = Proveedor::all();

        return view('backend.proveedor.index', compact('proveedores'));
    }
    /*
     *Ajustes
     */
    public function ajustes()
    {
        return view('backend.ajustes.index');
    }
    /*
     * Dashboard
     */
    public function dashboard()
    {
        return view('backend.dashboard.index');
    }
  
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prestacion_tipo = PrestacionTipo::all();
        return view('backend.proveedor.create', compact('prestacion_tipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required',
            'prestacion_tipo_id' => 'required',
            'email' => 'required|email',
            'telefono' => 'required'
        ]);

        Proveedor::create($request->except('_token'));

        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.proveedores.index');


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Proveedor $proveedor)
    {
        $prestacion_tipo = PrestacionTipo::all();
        return view('backend.proveedor.edit')->with([
            'proveedor' => $proveedor->findOrFail($id),
            'prestacion_tipo' => $prestacion_tipo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Proveedor $proveedor)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required',
            'prestacion_tipo_id' => 'required',
            'email' => 'required|email',
            'telefono' => 'required'
        ]);

        $proveedor = $proveedor->findOrFAil($id);

        $proveedor->fill($request->except('_token'))->update();

        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.proveedores.index');
    }
}
