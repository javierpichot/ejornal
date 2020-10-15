<?php

namespace App\Http\Controllers\Empresa;

use App\Models\Empresa;
use App\Models\PrestacionDrogaTipo;
use App\Models\PrestacionFarmaciaDroga;

use App\Traits\CheckEmpresaTrait;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Spatie\Activitylog\Models\Activity;

use Yajra\DataTables\DataTables;

/**
 * Class FarmaciaDrogaController
 * @package App\Http\Controllers\Empresa
 */
class FarmaciaDrogaController extends Controller
{
    use CheckEmpresaTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($empresa_id)
    {
        $this->checkEmpresa($empresa_id);
        $empresa = Empresa::with(['farmacia'])->findOrFail($empresa_id);
        $tipo_farmaco = PrestacionDrogaTipo::get();
        return view('empresa.farmacia.index', compact('empresa', 'tipo_farmaco'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'nombre' => 'required|string|max:191',
            'via_prestacion' => 'required|string|max:191',
            'cantidad' => 'required|numeric',
            'fecha_caducidad' => 'required|nullable|date',
            'prestacion_droga_tipo_id' => 'required',
            'empresa_id' => 'required'
        );
        $validator = $this->validate($request,$rules);
        $this->checkEmpresa($request->input('empresa_id'));

        $empresa = Empresa::findOrFail($request->input('empresa_id'));

        $farmaco = PrestacionFarmaciaDroga::create($request->except('_token'));


        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'fail' => false,
                'text' => 'El farmaco fue creado exitosamente..!',
                'redirect_url' => route('empresa.farmacos.index', ['id' => $empresa->id, 'name' => $empresa->nombre] )
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
        $farmaco = PrestacionFarmaciaDroga::findOrFail($id);
        $tipo_farmaco = PrestacionDrogaTipo::get();

        return view('empresa.farmacia._form', compact('farmaco', 'tipo_farmaco', 'empresa'));

    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function getUpdate(Request $request, $id)
    {
        $this->checkEmpresa($request->input('empresa_id'));
        $empresa = Empresa::findOrFail($request->input('empresa_id'));
        $farmaco = PrestacionFarmaciaDroga::findOrFail($id);
        $farmaco->fill($request->except('_token', 'empresa_id'))->update();

        if (!$request->ajax()){
            Session::flash('alert', 'Los datos se han almacenado exitosamente.');
            return redirect()->route('empresa.farmacos.index', ['id' => $empresa->id, 'name' => $empresa->nombre]);
        } else {

            return response()->json([
                'fail' => false,
                'text' => 'El farmaco fue editado..!',
                'redirect_url' => route('empresa.farmacos.index', ['id' => $empresa->id, 'name' => $empresa->nombre] )
            ]);
        }

    }
    /**
     * [update description]
     * @param  Request $request    [description]
     * @param  [type]  $id         [description]
     * @param  [type]  $empresa_id [description]
     * @return [type]              [description]
     */
    public function update(Request $request, $id, $empresa_id)
    {
        $this->checkEmpresa($empresa_id);
        $farmaco = PrestacionFarmaciaDroga::findOrFail($id);

        if ($request->input('type') === 'increment') {

            $farmaco->increment('cantidad');
        }

        if ($request->input('type') === 'decrement') {
            $farmaco->decrement('cantidad');
        }
    }

    /**
     * @param $empresa_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function stockFamarcos($empresa_id)
    {
        $this->checkEmpresa($empresa_id);
        $empresa = Empresa::findOrFail($empresa_id);
        return view('empresa.farmacia.stock_farmacos', compact('empresa'));
    }


    protected function getFotoTrabajador($empresa_id, $trabajador)
    {
        return isset($trabajador->photo) ?  asset('storage/empresas/'. $empresa_id . '/trabajadores/' . $trabajador->id . '/perfil/'. $trabajador->photo . '') : asset('img/avatar5.png');
    }


    /**
     * @param $empresa_id
     * @return mixed
     * @throws \Exception
     */
    public function getFarmacos($empresa_id)
    {
        $farmaco = DB::table('consulta_prestacion_farmacia_droga')
                        ->join('prestacion_farmacia_drogas', 'consulta_prestacion_farmacia_droga.prestacion_farmacia_droga_id', '=', 'prestacion_farmacia_drogas.id')
                        ->join('trabajadors', 'consulta_prestacion_farmacia_droga.trabajador_id', '=', 'trabajadors.id')
                        ->join('empresas', 'prestacion_farmacia_drogas.empresa_id', '=', 'empresas.id')
                        ->join('consultas', 'consulta_prestacion_farmacia_droga.consulta_id', '=', 'consultas.id')
                        ->join('users', 'consultas.user_id', '=', 'users.id')
                        ->join('consulta_motivos', 'consultas.consulta_motivo_id', '=', 'consulta_motivos.id')
                        ->where('prestacion_farmacia_drogas.empresa_id', $empresa_id)
                        ->select('trabajadors.nombre','trabajadors.apellido', 'trabajadors.id', 'prestacion_farmacia_drogas.nombre as nombre_farmaco', 'empresas.nombre as nombre_empresa', 'consulta_prestacion_farmacia_droga.cantidad', 'consulta_motivos.nombre as motivo_consulta','users.nombre as nombre_profesional','consultas.created_at as fecha_consulta','users.apellido as apellido_profesional')
                        ->get();

        return DataTables::of($farmaco)
->addColumn('foto', function ($farmaco) use ($empresa_id) {
            return '<a href="'.route('trabajador.show', ['id' => $farmaco->id, 'name' => $farmaco->nombre, 'empresa_id' => $empresa_id]).'"><img src="'.
            $this->getFotoTrabajador($empresa_id, $farmaco)
            .'" class="img-circle elevation-2" width="55px"/></a>';
        })
          
          ->addColumn('trabajador', function ($farmaco)  {
            return $farmaco->apellido.' '.$farmaco->nombre;
        })
                ->addColumn('fecha_consulta', function ($farmaco) {
                    return $farmaco->fecha_consulta;
                })

                ->addColumn('nombre_farmaco', function ($farmaco) {
                return $farmaco->nombre_farmaco;
                })
                ->addColumn('cantidad', function ($farmaco) {
                    return $farmaco->cantidad;
                })
                ->addColumn('motivo_consulta', function ($farmaco) {
                    return $farmaco->motivo_consulta;
                })
                ->addColumn('profesional', function ($farmaco) {
                    return $farmaco->nombre_profesional.' '.$farmaco->apellido_profesional;
                })
                ->make(true);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $this->checkEmpresa($request->input('empresa_id'));
        $farmaco = PrestacionFarmaciaDroga::findOrFail($id);

        if( $farmaco->delete() ) {
            $response = [
                'id'        =>  $farmaco->id,
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
