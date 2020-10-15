<?php

namespace App\Http\Controllers\Trabajador;

use App\Models\Empresa;
use App\Models\Ausentismo;
use App\Models\Incidencia;
use App\Models\Trabajador;
use App\Models\AusentismoTipo;
use App\Models\ConsultaMotivo;

use App\Traits\CheckEmpresaTrait;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use Spatie\Activitylog\Models\Activity;

class ExpedienteController extends Controller
{
    use CheckEmpresaTrait;
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'empresa_id' => 'required',
            'trabajador_id' => 'required',
            'ausentismo_tipo_id' => 'required',
            'consulta_motivo_id' => 'required',
            'user_id' => 'required'
        ]);
        $this->checkEmpresa($request->input('empresa_id'));
        $empresa = Empresa::findOrFail($request->input('empresa_id'));
        $trabajador = Trabajador::findOrFail($request->input('trabajador_id'));
        


        $ausentismo = $trabajador->ausentismo()->create($request->except('_token', 'trabajador_id'));
        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'fail' => false,
                'text' => 'ELl expediente fue creado exitosamente..!',
                'redirect_url' => route('trabajador.expediente.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id] )
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id, $empresa_id)
     {
         $this->checkEmpresa(decrypt($empresa_id));
         $empresa = Empresa::findOrFail(decrypt($empresa_id));

         $trabajador = Trabajador::with(['ausentismo.trabajador', 'ausentismo.user', 'ausentismo.ausentismo_tipo'])->findOrFail(decrypt($id));
         $incidencias = Incidencia::where('trabajador_id', $trabajador->id)->get();
         $tipo_ausencia = AusentismoTipo::get();
         $consulta_motivo = ConsultaMotivo::get();

         return view('trabajador.expediente.show', compact('trabajador', 'empresa', 'incidencias', 'tipo_ausencia','consulta_motivo'));
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit(Request $request, $id, $empresa_id, $trabajador_id)
     {
         $this->checkEmpresa($empresa_id);
         $empresa = Empresa::findOrFail($empresa_id);
         $trabajador = Trabajador::findOrFail($trabajador_id);
         $incidencias = Incidencia::where('trabajador_id', $trabajador->id)->get();
         $tipo_ausencia = AusentismoTipo::get();
         $ausentismo = Ausentismo::findOrFail($id);
         $consulta_motivo = ConsultaMotivo::get();


         return view('trabajador.expediente._form', compact('incidencias','tipo_ausencia', 'ausentismo', 'trabajador', 'empresa','consulta_motivo'));
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
        $this->checkEmpresa($request->input('empresa_id'));
        $empresa = Empresa::findOrFail($request->input('empresa_id'));
        $trabajador = Trabajador::find($request->input('trabajador_id'));

        $ausentismo = Ausentismo::findOrFail($id);


        $ausentismo->fill($request->except('_method', '_token'))->update();

        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'fail' => false,
                'text' => 'El expediente fue editado exitosamente..!',
                'redirect_url' => route('trabajador.expediente.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id] )
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(Request $request, $id)
     {
         $this->checkEmpresa($request->input('empresa_id'));
         $trabajador = Trabajador::find($request->input('trabajador_id'));
         $ausentismo = Ausentismo::findOrFail($id);

         if( $ausentismo->delete() ) {
             $response = [
                 'id'        =>  $ausentismo->id,
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
