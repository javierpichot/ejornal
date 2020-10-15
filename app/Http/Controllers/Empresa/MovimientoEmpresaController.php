<?php

namespace App\Http\Controllers\Empresa;

use App\Models\Empresa;

use App\Traits\CheckEmpresaTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use OwenIt\Auditing\Models\Audit;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class MovimientoEmpresaController
 * @package App\Http\Controllers\Empresa
 */
class MovimientoEmpresaController extends Controller
{
    use  CheckEmpresaTrait;
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa = Empresa::findOrFail($id);

        return view('empresa.movimientos.index', compact('empresa'));
    }

    /**
     * @param $empresa_id
     * @return mixed
     * @throws \Exception
     */
    public function getMovimientos($empresa_id)
    {
        $this->checkEmpresa($empresa_id);
        $actividades = DB::table('audits')->join('users as creator', 'creator.id', '=', 'audits.user_id')->where('new_values->empresa_id', $empresa_id)->orderBy('audits.created_at', 'desc')->get();

        return DataTables::of($actividades)
            ->addColumn('created_at', function ($actividades) {
                return $actividades->created_at;
            })
            ->addColumn('usuario', function ($actividades) {
                return $actividades->nombre ."-". $actividades->apellido;
            })
            ->addColumn('tipo', function ($actividades) {
                return json_encode($actividades->event);
            })
            ->addColumn('navegador', function ($actividades) {
                return json_encode($actividades->user_agent);
            })
            ->addColumn('auditable_type', function ($actividades) {
                return $actividades->auditable_type;
            })
            ->addColumn('parametros_created', function ($actividades) {
                return json_encode($actividades->new_values);
            })
            ->addColumn('parametros_updated', function ($actividades) {
                return json_encode($actividades->old_values);
            })
            ->addColumn('ip', function ($actividades){
                return json_encode($actividades->ip_address);
            })
            ->make(true);
    }
}
