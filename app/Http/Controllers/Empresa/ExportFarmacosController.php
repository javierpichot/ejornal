<?php

namespace App\Http\Controllers\Empresa;

use App\Exports\FarmacosExport;
use App\Exports\FarmacosExportHistorico;
use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Traits\CheckEmpresaTrait;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportFarmacosController extends Controller
{
    use CheckEmpresaTrait;

    public function index($id, $name)
    {
        $this->checkEmpresa($id);
        $empresa = Empresa::findOrFail($id);
        return view('exports.farmacos_index', compact('empresa'));
    }

    public function exportsFarmacos(Request $request)
    {
        $this->checkEmpresa($request->input('empresa_id'));
        return Excel::download(new FarmacosExport($request->input('empresa_id')), 'farmacos.xlsx');
    }

    public function exportsFarmacosHistoricos(Request $request)
    {
        $this->checkEmpresa($request->input('empresa_id'));
        return Excel::download(new FarmacosExportHistorico($request->input('empresa_id')), 'farmacos_historicos.xlsx');
    }
}
