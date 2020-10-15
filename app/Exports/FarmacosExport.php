<?php

namespace App\Exports;

use App\Models\Empresa;
use App\Models\PrestacionFarmaciaDroga;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class FarmacosExport implements FromView,
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
        return view('exports.farmacos_empresa', [
            'farmacos' => Empresa::find($this->empresa_id),
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
