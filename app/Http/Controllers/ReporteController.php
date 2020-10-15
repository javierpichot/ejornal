<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 30/10/18
 * Time: 07:33 AM
 */

namespace App\Http\Controllers;


use App\Exports\ComunicacionesExport;
use App\Exports\ConsultasExport;
use App\Exports\DocumentacionesExport;
use App\Exports\DocumentacionTrabajadoresExport;
use DateTime;

use App\Models\Calendario;
use App\Models\Comunicacion;
use App\Models\Empresa;
use App\Models\Documentacion;
use App\Models\DocumentacionEmpresa;
use App\Traits\CheckEmpresaTrait;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ReporteController
 * @package App\Http\Controllers
 */
class ReporteController extends Controller
{
    use CheckEmpresaTrait;

    /**
     * @param $empresa_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($empresa_id)
    {
        $this->checkEmpresa($empresa_id);
        $empresa = Empresa::findOrFail($empresa_id);
        return view('reportes.index', compact('empresa'));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadReporteComunicacion(Request $request)
    {
        $this->checkEmpresa($request->input('empresa_id'));
        return Excel::download(new ComunicacionesExport($request->input('empresa_id'), $request->input('fecha_inicio'), $request->input('fecha_fin')), 'comunicaciones.xlsx');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadReporteDocumetacionEmpresa(Request $request)
    {
          $this->checkEmpresa($request->input('empresa_id'));
        return Excel::download(new DocumentacionesExport($request->input('empresa_id'), $request->input('fecha_inicio'), $request->input('fecha_fin')), 'comunicaciones.xlsx');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadReporteDocumetacionTrabajadores(Request $request)
    {
          $this->checkEmpresa($request->input('empresa_id'));
        return Excel::download(new DocumentacionTrabajadoresExport($request->input('empresa_id'), $request->input('fecha_inicio'), $request->input('fecha_fin')), 'documentacion_recibida.xlsx');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadReporteConsultas(Request $request)
    {
        $this->checkEmpresa($request->input('empresa_id'));
        return Excel::download(new ConsultasExport($request->input('empresa_id'), $request->input('fecha_inicio'), $request->input('fecha_fin')), 'consultas_atendidas.xlsx');
    }
}
