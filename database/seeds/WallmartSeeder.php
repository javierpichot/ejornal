<?php

use App\Models\Empresa;
use App\Models\Trabajador;

use Carbon\Carbon;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class WallmartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {




     
        $empresa = Empresa::create([
            'nombre' => 'Wallmart',
            'cuit' => '123456723890',
            'direccion' => 'Camino de la gominola 2400',
            'logo' => 'wallmart.jpeg',
            'caducidad' => '2019-11-01',
            'created_at' => '2018-05-01 16:29:37'
        ]);
       
      


    }
}
