<?php

namespace App\Http\Controllers\Empresa;

use App\Models\Empresa;
use App\Models\PrestacionPedido;

use App\Traits\CheckEmpresaTrait;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MedicoDomicilioController extends Controller
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
        $empresa = Empresa::findOrFail($empresa_id);
        $prestaciones = PrestacionPedido::where('prestacion_tipo_id', 1)->get();
        return view('empresa.medico_domicilio.index', compact('prestaciones', 'empresa'));
    }
}
