<?php

namespace App\Imports;

use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportTrabajadors implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $key =>  $row) {
            Trabajador::create([
                'nombre' => $row[0],
                'apellido' => $row[1],
                'documento' => $row[2],
                'empresa_id' => request()->input('empresa_id'),
                'import_created' => Carbon::now()
            ]);
        }
    }
}
