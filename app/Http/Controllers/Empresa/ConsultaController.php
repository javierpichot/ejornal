<?php
namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;

use App\Models\Empresa;
use App\Models\Consulta;
use App\Models\Ausentismo;
use App\Models\ConsultaTipo;
use App\Models\Documentacion;
use App\Models\ConsultaMotivo;
use App\Models\ConsultaReposo;
use App\Models\PrestacionFarmacia;
use App\Models\PrestacionFarmaciaDroga;


use App\Traits\CheckEmpresaTrait;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use Spatie\Activitylog\Models\Activity;

class ConsultaController extends Controller
{
    use CheckEmpresaTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_empresa)
    {
        $this->checkEmpresa($id_empresa);
        $empresa = Empresa::with(['consulta.consulta_tipo', 'consulta.documentacion', 'consulta.consulta_reposo', 'consulta.consulta_motivo', 'consulta.user'])->findOrFail($id_empresa);
        return view('empresa.consulta.index', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $id_empresa)
    {
        $this->checkEmpresa($id_empresa);

        $empresa = Empresa::findOrFail($id_empresa);

        $consulta = Consulta::with(['empresa', 'documentacion', 'consulta_reposo', 'consulta_motivo', 'consulta_tipo', 'trabajador', 'user', 'ausentismo', 'consulta_control', 'consulta_prestacion_farmacia_droga'])->findOrFail($id);


        $ausentismo = Ausentismo::where('trabajador_id', $consulta->trabajador_id)->get();
        $documentaciones = Documentacion::get();
        $consulta_reposo = ConsultaReposo::get();
        $consulta_motivo = ConsultaMotivo::get();
        $consulta_tipo = ConsultaTipo::get();
        $ausentismos = Ausentismo::get();
        $prestacion_farmacia_droga = PrestacionFarmaciaDroga::get();


        return view('empresa.consulta._form', compact('consulta', 'documentaciones', 'consulta_reposo', 'consulta_motivo', 'ausentismos', 'empresa', 'consulta_tipo', 'ausentismo', 'prestacion_farmacia_droga'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */



    public function update(Request $request, $id, $id_empresa)
    {

        $this->checkEmpresa($id_empresa);

        $consulta = Consulta::findOrFail($id);
        $empresa = Empresa::findOrFail($id_empresa);



        $consulta->fill($request->except('_token', '_method', 'empresa_id', 'tension_arterial', 'frecuencia_cardiaca', 'peso', 'altura', 'glucemia', 'saturacion_oxigeno'))->update();

        $consulta->consulta_control()->update([
            'tension_arterial' => $request->get('tension_arterial'),
            'frecuencia_cardiaca' => $request->get('frecuencia_cardiaca'),
            'peso' => $request->get('peso'),
            'altura' => $request->get('altura'),
            'glucemia' => $request->get('glucemia'),
            'saturacion_oxigeno' => $request->get('saturacion_oxigeno')
         ]);

         $cantidad = [];


         if ($request->has('prestacion_farmacia_droga_id') && $request->has('cantidad')) {
             $data = [];
             $arrayCantidad = [];
             foreach($request->cantidad as $key => $value) {
                 $arrayCantidad[] = $value;
             }
             foreach($request->prestacion_farmacia_droga_id as $key => $value) {
                 $data[$value] = ['cantidad' => $arrayCantidad[$key]];
             }
             //Actualizamos los medicamentos de la consulta
             $consulta->consulta_prestacion_farmacia_droga()->sync($data);
         }


    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consulta  $consulta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->checkEmpresa(request()->input('empresa_id'));
        $consulta = Consulta::findOrFail($id);



        if(  $consulta->delete() ) {
            $response = [
                'id'        =>  $consulta->id,
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
