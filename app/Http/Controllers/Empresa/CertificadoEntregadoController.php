<?php

namespace App\Http\Controllers\Empresa;

use App\Models\Empresa;
use App\Models\Documentacion;

use App\Traits\CheckEmpresaTrait;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CertificadoEntregadoController extends Controller
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
        $empresa = Empresa::findOrFail($id_empresa);
        $certificaciones = Documentacion::with(['trabajador', 'user', 'consulta.consulta_motivo'])->where('empresa_id', $id_empresa)->get();
        return view('empresa.certificados.index', compact('empresa', 'certificaciones'));
    }
}
