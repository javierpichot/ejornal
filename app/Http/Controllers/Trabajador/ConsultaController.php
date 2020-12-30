<?php

namespace App\Http\Controllers\Trabajador;

use App\Models\Diagnostico;
use App\Models\Empresa;
use App\Models\Consulta;
use App\Models\Ausentismo;
use App\Models\Trabajador;
use App\Models\ConsultaTipo;
use App\Models\Documentacion;
use App\Models\ConsultaMotivo;
use App\Models\ConsultaReposo;
use App\Models\PrestacionFarmaciaDroga;

use App\Traits\CheckEmpresaTrait;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Session;

use Spatie\Activitylog\Models\Activity;
use App\Models\Event;

/**
 * Class ConsultaController
 * @package App\Http\Controllers\Trabajador
 */
class ConsultaController extends Controller
{
    use CheckEmpresaTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getConsulta($id, $empresa_id, $trabajador_id)
    {
        $this->checkEmpresa($empresa_id);

        $empresa = Empresa::findOrFail($empresa_id);
        $trabajador = Trabajador::findOrFail($trabajador_id);

        $consulta = Consulta::with(['empresa', 'documentacion', 'consulta_reposo', 'consulta_motivo', 'consulta_tipo', 'trabajador', 'user', 'ausentismo', 'consulta_control', 'consulta_prestacion_farmacia_droga'])->findOrFail($id);


        $ausentismo = Ausentismo::where('trabajador_id', $consulta->trabajador_id)->get();
        $documentaciones = Documentacion::where('trabajador_id', $trabajador->id)->get();
        $consulta_reposo = ConsultaReposo::get();
        $consulta_motivo = ConsultaMotivo::get();
        $consulta_tipo = ConsultaTipo::get();
        $ausentismos = Ausentismo::where('trabajador_id', $trabajador->id)->get();
        $prestacion_farmacia_droga = PrestacionFarmaciaDroga::where('empresa_id', $empresa->id)->get();



        return view('trabajador.consulta.view', compact('consulta', 'documentaciones', 'consulta_reposo', 'consulta_motivo', 'ausentismos', 'empresa', 'consulta_tipo', 'ausentismo', 'prestacion_farmacia_droga', 'trabajador'));
    }

    /**
     * @param $arr
     * @return bool
     */
    protected function is_array_empty($arr){
      if(is_array($arr)){
          foreach($arr as $key => $value){
              if(!empty($value) || $value != NULL || $value != ""){
                  return true;
                  break;//stop the process we have seen that at least 1 of the array has value so its not empty
              }
          }
          return false;
      }
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
             'consulta_motivo_id' => 'required',
             'diagnostico_id' => 'required'
         ]);

         $this->checkEmpresa($request->input('empresa_id'));
         $empresa = Empresa::findOrFail($request->input('empresa_id'));
         $trabajador = Trabajador::findOrFail($request->input('trabajador_id'));

         $consulta = Consulta::create($request->except('_token', '_method', 'tension_arterial', 'frecuencia_cardiaca', 'peso', 'altura', 'glucemia', 'saturacion_oxigeno'));

         $consulta->consulta_control()->create([
             'trabajador_id' => $request->input('trabajador_id'),
             'tension_arterial' => $request->get('tension_arterial'),
             'frecuencia_cardiaca' => $request->get('frecuencia_cardiaca'),
             'peso' => $request->get('peso'),
             'altura' => $request->get('altura'),
             'glucemia' => $request->get('glucemia'),
             'saturacion_oxigeno' => $request->get('saturacion_oxigeno')
          ]);

          $cantidad = [];


          if ($this->is_array_empty($request->get('prestacion_farmacia_droga_id')) && $this->is_array_empty($request->get('cantidad'))) {
              $data = [];
              $arrayCantidad = [];
              $stock = [];
              foreach($request->cantidad as $key => $value) {
                  $arrayCantidad[] = $value;
              }
              foreach($request->prestacion_farmacia_droga_id as $key => $value) {
                  $data[$value] = ['cantidad' => $arrayCantidad[$key], 'trabajador_id' => $trabajador->id];
                  $prestacion_farmacia = PrestacionFarmaciaDroga::findOrFail($value);
                  $prestacion_farmacia->decrement('cantidad', $arrayCantidad[$key]);
              }
              //Actualizamos los medicamentos de la consulta
              $consulta->consulta_prestacion_farmacia_droga()->sync($data);
          }

         if (!$request->ajax()){
             Session::flash('alert', 'Los datos se han almacenado exitosamente.');
             return redirect()->route('trabajador.consulta.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]);
         } else {

             return response()->json([
                 'fail' => false,
                 'text' => 'La consulta fue creada exitosamente..!',
                 'redirect_url' => route('trabajador.consulta.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id] )
             ]);
         }


     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id, $name, $empresa_id)
     {
        $this->checkEmpresa($empresa_id);
        $empresa = Empresa::findOrFail($empresa_id);

        $trabajador = Trabajador::findOrFail($id);


        $cita = Event::whereDate('start_date', '>=', \Carbon\Carbon::now()->format('Y-m-d'))->where('trabajador_id', $trabajador->id)->first();

        /*$documentaciones = Documentacion::where('trabajador_id', $trabajador->id)->get();
         $consulta_reposo = ConsultaReposo::get();
         $consulta_motivo = ConsultaMotivo::get();
         $consulta_tipo = ConsultaTipo::get();
         $ausentismos = Ausentismo::where('trabajador_id', $trabajador->id)->get();
         $diagnostico = Diagnostico::get();
         $prestacion_farmacia_droga = PrestacionFarmaciaDroga::where('empresa_id', $empresa->id)->get();*/


         return view('trabajador.consulta.show', compact('trabajador', 'empresa', 'cita'));
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

        $consulta = Consulta::with(['empresa', 'documentacion', 'consulta_reposo', 'consulta_motivo', 'consulta_tipo', 'trabajador', 'user', 'ausentismo', 'consulta_control', 'consulta_prestacion_farmacia_droga'])->findOrFail($id);


        $ausentismo = Ausentismo::where('trabajador_id', $consulta->trabajador_id)->get();
        $documentaciones = Documentacion::where('trabajador_id', $trabajador->id)->get();
        $consulta_reposo = ConsultaReposo::get();
        $consulta_motivo = ConsultaMotivo::get();
        $consulta_tipo = ConsultaTipo::get();
        $ausentismos = Ausentismo::where('trabajador_id', $trabajador->id)->get();
        $prestacion_farmacia_droga = PrestacionFarmaciaDroga::get();
        $diagnostico = Diagnostico::where('consulta_motivo_id', $consulta->consulta_motivo_id)->get();


        return view('trabajador.consulta._form', compact('consulta', 'documentaciones', 'consulta_reposo', 'consulta_motivo', 'ausentismos', 'empresa', 'consulta_tipo', 'ausentismo', 'prestacion_farmacia_droga', 'diagnostico'));
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

        $consulta = Consulta::findOrFail($id);
        $empresa = Empresa::findOrFail($request->input('empresa_id'));
        $trabajador = Trabajador::find($request->input('trabajador_id'));



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


         if ($this->is_array_empty($request->get('prestacion_farmacia_droga_id')) && $this->is_array_empty($request->get('cantidad'))) {
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


         if (!$request->ajax()){
             Session::flash('alert', 'Los datos se han almacenado exitosamente.');
             return redirect()->route('trabajador.consulta.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id]);
         } else {

             return response()->json([
                 'fail' => false,
                 'text' => 'La consulta fue creada exitosamente..!',
                 'redirect_url' => route('trabajador.consulta.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id] )
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
         $consulta = Consulta::findOrFail($id);

         if( $consulta->delete() ) {
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
