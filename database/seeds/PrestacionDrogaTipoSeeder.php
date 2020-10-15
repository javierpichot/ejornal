<?php

use App\Models\Empresa;
use App\Models\PrestacionDrogaTipo;
use Carbon\Carbon;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class PrestacionDrogaTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        PrestacionDrogaTipo::create([
            'nombre' => 'Analgesico'
        ]);

        PrestacionDrogaTipo::create([
            'nombre' => 'Antibiotico'
        ]);

        PrestacionDrogaTipo::create([
            'nombre' => 'Antihipetensivo'
        ]);

        PrestacionDrogaTipo::create([
            'nombre' => 'Gastrointestinal'
        ]);

        PrestacionDrogaTipo::create([
            'nombre' => 'Respiratorio'
        ]);

        PrestacionDrogaTipo::create([
            'nombre' => 'Psiquiatrico'
        ]);

        PrestacionDrogaTipo::create([
            'nombre' => 'Antialergico'
        ]);       
      


    }
}
