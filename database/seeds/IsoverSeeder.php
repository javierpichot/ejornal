<?php

use App\Models\Empresa;
use App\Models\Trabajador;

use Carbon\Carbon;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class IsoverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $empresa = Empresa::create([
            'nombre' => 'Isover',
            'cuit' => '1234567823490',
            'direccion' => 'Bouchard y Einz - Llavallol',
            'logo' => 'isover.jpg',
            'caducidad' => '2019-11-01',
            'created_at' => '2018-05-01 16:29:37'
        ]);
      


    }
}
