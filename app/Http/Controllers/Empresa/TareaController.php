<?php

namespace App\Http\Controllers\Empresa;

use App\Models\AgenteRiesgo;
use App\Models\Empresa;
use App\Models\Tarea;

use App\Traits\CheckEmpresaTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class TareaController
 * @package App\Http\Controllers\Empresa
 */
class TareaController extends Controller
{
    use CheckEmpresaTrait;

    /**
     * @param $id_empresa
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id_empresa)
    {
        $this->checkEmpresa($id_empresa);
        $empresa = Empresa::findOrFail($id_empresa);
        $tareas = Tarea::where('empresa_id', $id_empresa)->get();
        $agentes_riegos = AgenteRiesgo::get();
        return view('empresa.tarea.index', compact('tareas', 'empresa', 'agentes_riegos'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->checkEmpresa($request->post('empresa_id'));
        $empresa = Empresa::findOrFail($request->input('empresa_id'));
        $tarea = Tarea::created($request->except('_token', '_method', 'empresa_id', 'agente_riesgo_id'));

        if ($this->is_array_empty($request->get('agente_riesgo_id'))) {
            $data = [];
            $arrayAgenteRiego = [];
            foreach($request->agente_riesgo_id as $key => $value) {
                $data[$value] = ['tarea_id' => $tarea->id, 'agente_riesgo_id' => $value];
            }


            //Actualizamos los medicamentos de la consulta
            $tarea->agente_riesgo_tarea()->sync($data);
        }

        if (!$request->ajax()){
            Session::flash('alert', 'Los datos se han almacenado exitosamente.');
            return redirect()->route('empresa.tarea.agentes.index', ['id' => $empresa->id, 'name' => $empresa->nombre] );
        } else {

            return response()->json([
                'fail' => false,
                'text' => 'Los datos se han almacenado exitosamente.',
                'redirect_url' => route('empresa.tarea.agentes.index', ['id' => $empresa->id, 'name' => $empresa->nombre] )
            ]);
        }
    }

    /**
     * @param $id
     * @param $empresa_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, $empresa_id)
    {
        $this->checkEmpresa($empresa_id);
        $empresa = Empresa::findOrFail($empresa_id);
        $tarea = Tarea::with(['agente_riesgo_tarea'])->findOrFail($id);
        $agentes_riegos = AgenteRiesgo::get();
        return view('empresa.tarea.includes.form', compact('agentes_riegos', 'tarea', 'empresa'));
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
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $empresa = Empresa::findOrFail($request->input('empresa_id'));
        $tarea->fill($request->except('_token', '_method', 'empresa_id', 'agente_riesgo_id'))->update();

        if ($this->is_array_empty($request->get('agente_riesgo_id'))) {
            $data = [];
            $arrayAgenteRiego = [];
            foreach($request->agente_riesgo_id as $key => $value) {
                $data[$value] = ['tarea_id' => $id, 'agente_riesgo_id' => $value];
            }


            //Actualizamos los medicamentos de la consulta
            $tarea->agente_riesgo_tarea()->sync($data);
        }

        if (!$request->ajax()){
            Session::flash('alert', 'Los datos se han almacenado exitosamente.');
            return redirect()->route('empresa.tarea.agentes.index', ['id' => $empresa->id, 'name' => $empresa->nombre] );
        } else {

            return response()->json([
                'fail' => false,
                'text' => 'Los datos se han almacenado exitosamente.',
                'redirect_url' => route('empresa.tarea.agentes.index', ['id' => $empresa->id, 'name' => $empresa->nombre] )
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
         $categoria = Tarea::where('nombre', $request->nombre)->where('empresa_id', $id);

         $categoria->delete();
     }
}
