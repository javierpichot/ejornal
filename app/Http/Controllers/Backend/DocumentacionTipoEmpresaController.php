<?php

namespace App\Http\Controllers\Backend;

use App\Models\DocumentacionEmpresaTipo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Session;

class DocumentacionTipoEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentacion_tipo_empresa = DocumentacionEmpresaTipo::all();
        return view('backend.tipo_documentacion_empresa.index', compact('documentacion_tipo_empresa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tipo_documentacion_empresa.create');
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

        DocumentacionEmpresaTipo::create($request->except('_token'));

        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.documentacion_tipo_empresa.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.tipo_documentacion_empresa.edit')->with([
            'documentacion_tipo_empresa' => DocumentacionEmpresaTipo::findOrFail($id),
        ]);
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
        $this->validate($request, [
            'nombre' => 'required',
        ]);
        $documentacion_tipo_empresa = DocumentacionEmpresaTipo::findOrFail($id);
        $documentacion_tipo_empresa->fill($request->except('_token'))->update();

        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.documentacion_tipo_empresa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documentacion_tipo_empresa = DocumentacionEmpresaTipo::findOrFail($id);
        if( $documentacion_tipo_empresa->delete() ) {
            $response = [
                'id'        =>  $documentacion_tipo_empresa->id,
                'status'    =>  'success',
                'message'   =>  'Registro eliminado',
            ];
        } else {
            $response = [
                'status'    =>  'error',
                'message'   =>  'Intente nuevamente'
            ];
        }

        if( \request()->ajax() ) {
            return new JsonResponse($response);
        } else {

        }
    }
}
