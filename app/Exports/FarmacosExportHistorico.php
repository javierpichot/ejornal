<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 5/13/2019
 * Time: 2:58 p.m.
 */

namespace App\Exports;

use App\Models\Empresa;
use App\Models\PrestacionFarmaciaDroga;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class FarmacosExportHistorico implements FromView,
    WithTitle,
    WithColumnFormatting,
    WithEvents
{
    protected $empresa_id;


    public function __construct($empresa_id)
    {
        $this->empresa_id = $empresa_id;
    }

    public function view(): View
    {
        return view('exports.farmacos_empresa_historico', [
            'farmacos' => DB::table('consulta_prestacion_farmacia_droga')
                ->join('prestacion_farmacia_drogas', 'consulta_prestacion_farmacia_droga.prestacion_farmacia_droga_id', '=', 'prestacion_farmacia_drogas.id')
                ->join('trabajadors', 'consulta_prestacion_farmacia_droga.trabajador_id', '=', 'trabajadors.id')
                ->join('empresas', 'prestacion_farmacia_drogas.empresa_id', '=', 'empresas.id')
                ->join('consultas', 'consulta_prestacion_farmacia_droga.consulta_id', '=', 'consultas.id')
                ->join('turnos', 'trabajadors.turno_id', '=', 'turnos.id')

                ->join('users', 'consultas.user_id', '=', 'users.id')
                ->join('consulta_motivos', 'consultas.consulta_motivo_id', '=', 'consulta_motivos.id')
                ->where('prestacion_farmacia_drogas.empresa_id', $this->empresa_id)
                ->select('trabajadors.nombre','trabajadors.apellido', 'trabajadors.numero_legajo','trabajadors.documento','turnos.nombre as nombre_turno', 'trabajadors.id', 'prestacion_farmacia_drogas.nombre as nombre_farmaco', 'empresas.nombre as nombre_empresa', 'consulta_prestacion_farmacia_droga.cantidad', 'consulta_motivos.nombre as motivo_consulta','users.nombre as nombre_profesional','consultas.created_at as fecha_consulta','users.apellido as apellido_profesional')
                ->get(),
            'empresa' => Empresa::find($this->empresa_id)
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_GENERAL,
            'B' => NumberFormat::FORMAT_GENERAL,
            'C' => NumberFormat::FORMAT_GENERAL,
            'D' => NumberFormat::FORMAT_GENERAL,
            'E' => NumberFormat::FORMAT_GENERAL,
            'F' => NumberFormat::FORMAT_GENERAL,
            'G' => NumberFormat::FORMAT_GENERAL
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->getSheet()->autoSize();
                $event->getSheet()->getDelegate()->getStyle('A1:C11')
                    ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }
        ];
    }


    public function title(): string
    {
        return 'Farmacos';
    }
}
