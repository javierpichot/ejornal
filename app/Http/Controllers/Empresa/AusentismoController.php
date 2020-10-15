<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;

use App\Models\Empresa;
use App\Models\Ausentismo;
use App\Models\Calendario;
use App\Models\Incidencia;
use App\Models\AusentismoTipo;
use App\Traits\CheckEmpresaTrait;
use App\Models\ConsultaMotivo;


use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;
use App\Http\Resources\AusentismoResource;

class AusentismoController extends Controller
{
    use CheckEmpresaTrait;

    protected $model;

    public function __construct(Ausentismo $model)
    {
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_empresa)
    {
        $this->checkEmpresa($id_empresa);
        $consulta_motivo = ConsultaMotivo::get();

        $empresa = Empresa::with(['ausentismo'])->findOrFail($id_empresa);
        return view('empresa.ausentismo.index', compact('empresa','consulta_motivo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ausentismo  $ausentismo
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $id_empresa)
    {
        $this->checkEmpresa($id_empresa);
        $consulta_motivo = ConsultaMotivo::get();

        $empresa = Empresa::findOrFail($id_empresa);

        $ausentismo = Ausentismo::findOrFail($id);
        $ausentismo_tipo = AusentismoTipo::get();
        return view('empresa.incidencias._form', compact('ausentismo', 'ausentismo_tipo','consulta_motivo'));
    }

    protected function getFotoTrabajador($empresa_id, $trabajador)
    {
        return isset($trabajador->photo) ?  asset('storage/empresas/'. $empresa_id . '/trabajadores/' . $trabajador->id . '/perfil/'. $trabajador->photo . '') : asset('img/avatar5.png');
    }

    public function getAusentismoJson(Request $request)
    {
        $scopes = [];
        foreach ($request->all() as $scope => $value) {
            $scopes[$scope] = $value;
        }
        $this->checkEmpresa($scopes['empresa']);
        
        if(isset($scopes['whereDateBetweenIni']) && isset($scopes['whereDateBetweenFin'])) {
          $ausentismo = $this->getFilterwhereDateBetweenScope($scopes['empresa'], $scopes['whereDateBetweenIni'], $scopes['whereDateBetweenFin'], $limit = 10);
        } else {
          $ausentismo = $this->getAusentismoScope($scopes['empresa'], $scopes);
        }
        return AusentismoResource::collection($ausentismo);       
    }

    protected function getAusentismoScope($empresa, array $scopes = [], $limit = 10)
    {
        $model = $this->model->with(['empresa', 'trabajador', 'ausentismo_tipo', 'user', 'incidencia'])->withCount('documentacion', 'comunicacion', 'consulta')->where('empresa_id', $empresa)->orderBy('created_at', 'desc');
        $model = $this->applyScopes($scopes, $model);
        return $model->paginate($limit);
    }

    protected function getFilterwhereDateBetweenScope ($empresa, $dateIni, $dateFin, $limit) 
    {
      $model = $this->model->with(['empresa', 'trabajador', 'ausentismo_tipo', 'user', 'incidencia'])->withCount('documentacion', 'comunicacion', 'consulta')->where('empresa_id', $empresa)->orderBy('created_at', 'desc')->whereDateBetween($dateIni, $dateFin);
      return $model->paginate($limit);
    }

    protected function applyScopes(array $scopes = [], $model)
    {
        foreach ($scopes as $scope => $value) {
            if(!is_null($value)) {
                if (method_exists($this->model, 'scope'.studly_case($scope))) {
                    $model = $model->{$scope}($value);
                } 
            }
        }
        return $model;
    }
}
