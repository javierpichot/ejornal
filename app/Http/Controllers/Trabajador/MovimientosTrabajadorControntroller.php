<?php

namespace App\Http\Controllers\Trabajador;

use App\Traits\CheckEmpresaTrait;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use OwenIt\Auditing\Models\Audit;
use Yajra\DataTables\DataTables;

/**
 * Class MovimientosTrabajadorControntroller
 * @package App\Http\Controllers\Trabajador
 */
class MovimientosTrabajadorControntroller extends Controller
{
    use CheckEmpresaTrait;

    /**
     * @param $empresa_id
     * @param $trabajador_id
     * @return mixed
     * @throws \Exception
     */
    public function getMovimientos($empresa_id, $trabajador_id)
    {
        $this->checkEmpresa($empresa_id);
        $actividades = Audit::where('new_values->trabajador_id', $trabajador_id)->get();

        return DataTables::of($actividades)
            ->addColumn('created_at', function ($actividades) {
                return $actividades->created_at->diffForHumans();
            })
            ->addColumn('usuario', function ($actividades) {
                return $actividades->user->nombre ."-". $actividades->user->apellido;
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
