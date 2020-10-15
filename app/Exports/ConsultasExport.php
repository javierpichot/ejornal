<?php

namespace App\Exports;

use App\Models\Consulta;
use App\Models\Empresa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ConsultasExport implements
    FromView,
    WithTitle,
    WithColumnFormatting,
    WithEvents
{
    protected $fecha_inicio;
    protected $fecha_fin;
    protected $empresa_id;


    public function __construct($empresa_id, $fecha_inicio, $fecha_fin)
    {
        $this->empresa_id = $empresa_id;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
    }

    public function view(): View
    {
        return view('exports.consulta_trabajadores', [
            'consultas' => Consulta::where('empresa_id', $this->empresa_id)->whereBetween('created_at', array($this->fecha_inicio, $this->fecha_fin))->with(['trabajador', 'consulta_control', 'consulta_prestacion_farmacia_droga', 'empresa', 'documentacion', 'consulta_reposo', 'consulta_motivo', 'consulta_tipo', 'user', 'ausentismo'])->get(),
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
            'G' => NumberFormat::FORMAT_GENERAL,
            'H' => NumberFormat::FORMAT_GENERAL,
            'I' => NumberFormat::FORMAT_GENERAL,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->getSheet()->autoSize();
                $event->getSheet()->getDelegate()->getStyle('A1:C11')
                    ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }
        ];
    }


    public function title() : string {
        return 'Reporte de Consultas';
    }
}
