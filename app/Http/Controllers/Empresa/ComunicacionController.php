<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;

use App\Models\Empresa;
use App\Models\Comunicacion;
use App\Traits\CheckEmpresaTrait;

use Illuminate\Http\Request;

class ComunicacionController extends Controller
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
        $empresa = Empresa::with(['comunicacion'])->findOrFail($id_empresa);
        return view('empresa.comunicacion.index', compact('empresa'));
    }
}
