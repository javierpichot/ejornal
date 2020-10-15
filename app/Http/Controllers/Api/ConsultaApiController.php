<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\CheckEmpresaTrait;
use App\Models\Consulta;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Empresa;
use App\Models\Trabajador;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\PrestacionFarmaciaDroga;
use App\Models\ConsultaControl;

class ConsultaApiController extends Controller
{
    use CheckEmpresaTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->checkEmpresa($request->get('empresa_id'));
        $query = Consulta::with(['trabajador', 'consulta_tipo', 'user', 'ausentismo', 'consulta_motivo', 'consulta_reposo', 'documentacion', 'empresa', 'consulta_prestacion_farmacia_droga', 'consulta_control', 'consulta_diagnostico'])->where('trabajador_id', $request->get('trabajador_id'));

        if (request()->has('sort')) {
            // handle multisort
            $sorts = explode(',', request()->sort);
            foreach ($sorts as $sort) {
                list($sortCol, $sortDir) = explode('|', $sort);
                $query = $query->orderBy($sortCol, $sortDir);
            }
        } else {
            $query = $query->orderBy('id', 'asc');
        }

        if ($request->exists('filter')) {
            $value = "%{$request->filter}%";
            $query->whereHas('consulta_motivo', function (Builder $query) use ($request) {
                $value = "%{$request->filter}%";
                $query->where('nombre', 'like', $value);
            })->orWhereHas('consulta_tipo', function (Builder $query) use ($request) {
                $value = "%{$request->filter}%";
                $query->where('nombre', 'like', $value);
            })->orWhere('created_at', 'like', $value);
        }


        $perPage = request()->has('per_page') ? (int) request()->per_page : null;

        $pagination = $query->paginate($perPage);
        $pagination->appends([
            'sort' => request()->sort,
            'filter' => request()->filter,
            'per_page' => request()->per_page
        ]);
        
        return response()->json(
            $pagination
        );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'consulta.consulta_motivo_id' => 'required',
            'consulta.diagnostico_id' => 'required',
            'trabajador_id' => 'required',
            'user_id' => 'required',
            'empresa_id' => 'required'
        ]);

        $this->checkEmpresa($request->input('empresa_id'));
        $empresa = Empresa::findOrFail($request->input('empresa_id'));
        $trabajador = Trabajador::findOrFail($request->input('trabajador_id'));
        
        $consulta = Consulta::create([
            'entrevista' => $request->input('consulta.entrevista'), 
            'examen_fisico' => $request->input('consulta.examen_fisico'), 
            'examenes_complementarios' => $request->input('consulta.examenes_complementarios'), 
            'diagnostico' => $request->input('consulta.diagnostico'), 
            'tratamiento' => $request->input('consulta.tratamiento'), 
            'enfermeria' => $request->input('consulta.enfermeria'), 
            'fecha_consulta' => $request->input('consulta.fecha_consulta'), 
            'observacion' => $request->input('consulta.observacion'),  
            'trabajador_id' => $request->input('trabajador_id'),  
            'user_id' => $request->input('user_id'), 
            'empresa_id' => $request->input('empresa_id'),  
            'ausentismo_id' => !empty($request->input('ausentismo_id')) ? $request->input('ausentismo_id.id') : null, 
            'documentacion_id' => !empty($request->input('consulta.examen_fisico')) ? $request->input('consulta.examen_fisico.id'): null, 
            'consulta_reposo_id' => !empty($request->input('consulta.examen_fisico')) ? $request->input('consulta.examen_fisico.id') : null, 
            'consulta_motivo_id' => !empty($request->input('consulta.consulta_motivo_id')) ? $request->input('consulta.consulta_motivo_id.id') : null, 
            'consulta_tipo_id' => !empty($request->input('consulta.consulta_tipo_id')) ? $request->input('consulta.consulta_tipo_id.id') : null,  
            'nueva_cita' => $request->input('consulta.nueva_cita'), 
            'diagnostico_id' => !empty($request->input('consulta.diagnostico_id')) ? $request->input('consulta.diagnostico_id.id') : null, 
        ]);

        $consulta->consulta_control()->create([
            'trabajador_id' => $request->input('trabajador_id'),
            'tension_arterial' => $request->input('consulta.tension_arterial'),
            'frecuencia_cardiaca' => $request->input('consulta.frecuencia_cardiaca'),
            'peso' => $request->input('consulta.peso'),
            'altura' => $request->input('consulta.altura'),
            'glucemia' => $request->input('consulta.glucemia'),
            'saturacion_oxigeno' => $request->input('consulta.saturacion_oxigeno')
         ]);

         if ($this->is_array_empty($request->input('prestacion_farmacos'))) {
            $data = [];
            foreach ($request->input('prestacion_farmacos') as $key => $farmaco) {
                $data[] = ['cantidad' => $farmaco['cantidad'], 'trabajador_id' => $trabajador->id, 'prestacion_farmacia_droga_id' => $farmaco['prestacion_farmacia_droga_id']['id']];
                $prestacion_farmacia = PrestacionFarmaciaDroga::findOrFail($farmaco['prestacion_farmacia_droga_id']['id']);
                $prestacion_farmacia->decrement('cantidad', $farmaco['cantidad']);
            }
            $consulta->consulta_prestacion_farmacia_droga()->sync($data);
        }

         
         return response()->json()->setStatusCode(201);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $consulta->entrevista = $request->input('consulta.entrevista'); 
        $consulta->examen_fisico = $request->input('consulta.examen_fisico'); 
        $consulta->examenes_complementarios = $request->input('consulta.examenes_complementarios');
       
        $consulta->tratamiento = $request->input('consulta.tratamiento');
        $consulta->enfermeria = $request->input('consulta.enfermeria');
        $consulta->fecha_consulta = $request->input('consulta.fecha_consulta');
        $consulta->observacion = $request->input('consulta.observacion'); 
        $consulta->diagnostico_id = !empty($request->input('consulta.consulta_diagnostico')) ? $request->input('consulta.consulta_diagnostico.id') : null;
        $consulta->consulta_reposo_id = !empty($request->input('consulta.consulta_reposo')) ? $request->input('consulta.consulta_reposo.id') : null;
        $consulta->ausentismo_id = !empty($request->input('consulta.ausentismo')) ? $request->input('consulta.ausentismo.id') : null;
        $consulta->documentacion_id = !empty($request->input('consulta.documentacion')) ? $request->input('consulta.documentacion.id') : null;

        $consulta->save();


        if ($this->is_array_empty($request->input('consulta.consulta_prestacion_farmacia_droga'))) {
            $data = [];
            foreach ($request->input('consulta.consulta_prestacion_farmacia_droga') as $key => $farmaco) {
                $consulta->consulta_prestacion_farmacia_droga()->detach($farmaco['id']);
                $data[] = ['cantidad' => $farmaco['cantidad'], 'trabajador_id' => $request->input('consulta.trabajador_id'), 'prestacion_farmacia_droga_id' => $farmaco['id']];
              //  $prestacion_farmacia = PrestacionFarmaciaDroga::findOrFail($farmaco['id']);
               // $prestacion_farmacia->decrement('cantidad', $farmaco['cantidad']);
            }
            //dd($data);
            $consulta->consulta_prestacion_farmacia_droga()->sync($data);
        }

        ConsultaControl::updateOrCreate([
            'consulta_id' => $consulta->id
        ],[
            'tension_arterial' => $request->input('consulta.consulta_control.tension_arterial'),
            'frecuencia_cardiaca' => $request->input('consulta.consulta_control.frecuencia_cardiaca'),
            'peso' => $request->input('consulta.consulta_control.peso'),
            'altura' => $request->input('consulta.consulta_control.altura'),
            'glucemia' => $request->input('consulta.consulta_control.glucemia'),
            'saturacion_oxigeno' => $request->input('consulta.consulta_control.saturacion_oxigeno')
         ]);



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
        $consulta = Consulta::findOrFail($id);
        
        if( $consulta->delete() ) {
            $consulta->consulta_control()->delete();
            $response = [
                'status'    =>  'success',
                'message'   =>  'Registro eliminado',
            ];
        } else {
            $response = [
                'status'    =>  'error',
                'message'   =>  'Intente nuevamente'
            ];
        }
        return response()->json($response)->setStatusCode(204);
    }
}
