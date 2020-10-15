<?php

use App\Models\Empresa;
use App\Models\Trabajador;
use App\Models\PrestacionFarmaciaDroga;

use Carbon\Carbon;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {




      //                    EMPRESA                     //
      $empresa = Empresa::create([
        'nombre' => 'Test',
        'cuit' => '1234567890',
        'direccion' => 'Camino de la gominola 2400',
        'logo' => 'empresa_prueba.png',
        'caducidad' => '2019-11-01',
        'created_at' => '2018-05-01 16:29:37'
    ]);
    
//             TRABAJADORES                     //


  Trabajador::create([
    'nombre' => 'Escobar',
    'apellido' => 'de Taran',
    'documento' => '00000000',
    'direccion' => 'Bruselas 45',
    'photo' => 'tio1.jpg',
    'localidad' => '1',
    'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Pablo',
    'apellido' => 'Saravia',
    'documento' => '00000001',
    'photo' => 'tio2.jpg',
    'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Leon',
    'apellido' => 'De cuenca',
    'documento' => '00000002',
    'photo' => 'tio3.jpg',

    'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Pedro',
    'apellido' => 'Garcia Fontesar',
    'documento' => '00000003',
    'photo' => 'tio4.jpg',
    'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Jonathan',
    'apellido' => 'Romero Santos',
    'documento' => '00000004',
    'photo' => 'tio5.jpg',
  'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Bartolo',
    'apellido' => 'Aragonés',
    'documento' => '00000005',
    'photo' => 'tio6.jpg',
  'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Nicolás',
    'apellido' => 'Pereyra',
    'documento' => '00000006',
    'photo' => 'tio7.jpg',
    'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Pablo',
    'apellido' => 'de la Mar Arango',
    'documento' => '00000007',
    'photo' => 'tio8.jpg',
  'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Jaime',
    'apellido' => 'Lopez',
    'documento' => '00000008',
    'photo' => 'tio9.jpg',
  'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Tomás',
    'apellido' => 'Martinez',
    'documento' => '00000009',
    'photo' => 'tio9.jpg',
    'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Agustín',
    'apellido' => 'Montero de Mora',
    'documento' => '00000010',
    'photo' => 'tio10.jpg',
  'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Rodrigo',
    'apellido' => 'Duran Pinedo',
    'documento' => '00000011',
    'photo' => 'tio11.jpg',
    'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Blanca',
    'apellido' => 'Anchieta de Marchena',
    'documento' => '00000012',
    'photo' => 'tia1.jpg',
    'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Maria Torrijos Cespedes',
    'apellido' => 'Benito Arango',
    'documento' => '00000013',
    'photo' => 'tia2.jpg',
  'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Anna',
    'apellido' => 'Quiroga Lupian',
    'documento' => '00000014',
    'photo' => 'tia3.jpg',
  'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Beatriz',
    'apellido' => 'Pimentel de Villarubia',
    'documento' => '00000015',
    'photo' => 'tia4.jpg',
    'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Leonor',
    'apellido' => 'Rojas de Olivares',
    'documento' => '00000016',
    'photo' => 'tia5.jpg',
    'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Agueda',
    'apellido' => 'Huerta Miranda',
    'documento' => '00000017',
    'photo' => 'tia6.jpg',
    'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Aularia',
    'apellido' => 'Cacho Ropero',
    'documento' => '00000018',
    'photo' => 'tia7.jpg',
    'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Andrea',
    'apellido' => 'Rejon Torrellas',
    'documento' => '00000019',
    'photo' => 'tia8.jpg',
    'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Lucia',
    'apellido' => 'Preto Banegas',
    'documento' => '00000020',
    'photo' => 'tia9.jpg',
    'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);
Trabajador::create([
    'nombre' => 'Catalina',
    'apellido' => 'de Titosa Cuenca',
    'documento' => '00000021',
    'photo' => 'tia10.jpg',
    'empresa_id' => '1',
    'created_at' => Carbon::now(),
    'updated_at' => Carbon::now(),
]);




      $empresa->categoria()->create([
          'nombre' => 'Sin Convenio'
      ]);

      $empresa->sector()->create([
          'nombre' => 'Termoplasticos'
      ]);

      $empresa->sector()->create([
          'nombre' => 'Logistca'
      ]);


      $empresa->sector()->create([
          'nombre' => 'Mantenimiento'
      ]);

      $empresa->sector()->create([
          'nombre' => 'Almacen'
      ]);

      $empresa->sector()->create([
          'nombre' => 'Producción'
      ]);

      $empresa->sector()->create([
          'nombre' => 'RRHH'
      ]);

      $empresa->sector()->create([
          'nombre' => 'Vigilación'
      ]);

      $empresa->sector()->create([
          'nombre' => 'Administracion'
      ]);

      $empresa->turno()->create([
          'nombre' => 'Mañana'
      ]);

      $empresa->turno()->create([
          'nombre' => 'Tarde'
      ]);

      $empresa->turno()->create([
          'nombre' => 'Noche'
      ]);


      $empresa->tarea()->create([
          'nombre' => 'Supervisor'
      ]);

      $empresa->tarea()->create([
          'nombre' => 'Maquinista'
      ]);


      $empresa->tarea()->create([
          'nombre' => 'Operador'
      ]);

   
      PrestacionFarmaciaDroga::create([
        'nombre' => 'Ibuprofeno 600mg',
        'via_prestacion' => 'VO',
        'prestacion_droga_tipo_id' => 1,
        'empresa_id' => 1,
        'cantidad' => 1
    ]);

    PrestacionFarmaciaDroga::create([
        'nombre' => 'Ibuprofeno 400mg',
        'via_prestacion' => 'VO',
        'prestacion_droga_tipo_id' => 1,
        'empresa_id' => 1,
        'cantidad' => 4
    ]);

    PrestacionFarmaciaDroga::create([
        'nombre' => 'Paracetamol 500mg',
        'via_prestacion' => 'VO',
        'prestacion_droga_tipo_id' => 1,
        'empresa_id' => 1,
        'cantidad' => 56
    ]);

    PrestacionFarmaciaDroga::create([
        'nombre' => 'Aspirina 100mg',
        'via_prestacion' => 'VO',
        'prestacion_droga_tipo_id' => 1,
        'empresa_id' => 1,
        'cantidad' => 98
    ]);

    PrestacionFarmaciaDroga::create([
        'nombre' => 'Diclofenaco 50mg',
        'via_prestacion' => 'VO',
        'prestacion_droga_tipo_id' => 1,
        'empresa_id' => 1,
        'cantidad' => 12
    ]);

    PrestacionFarmaciaDroga::create([
        'nombre' => 'Diclofenaco 75 mg',
        'via_prestacion' => 'VO',
        'prestacion_droga_tipo_id' => 1,
        'empresa_id' => 1,
        'cantidad' => 12
    ]);

    PrestacionFarmaciaDroga::create([
        'nombre' => 'Diclofenaco 50mg + Pridinol 4mg',
        'via_prestacion' => 'VO',
        'prestacion_droga_tipo_id' => 1,
        'empresa_id' => 1,
        'cantidad' => 12
    ]);



    }
}
