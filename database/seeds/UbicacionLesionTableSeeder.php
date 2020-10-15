<?php

use Illuminate\Database\Seeder;
use App\Models\UbicacionLesion;


use Carbon\Carbon;

class UbicacionLesionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      UbicacionLesion::create([
          'nombre' => 'Región craneana',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      UbicacionLesion::create([
          'nombre' => 'Cara',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      UbicacionLesion::create([
          'nombre' => 'Ojos',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      UbicacionLesion::create([
          'nombre' => 'Oido',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      UbicacionLesion::create([
          'nombre' => 'Boca',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      UbicacionLesion::create([
          'nombre' => 'Nariz',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      UbicacionLesion::create([
          'nombre' => 'Torax',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      UbicacionLesion::create([
          'nombre' => 'Abdomen',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      UbicacionLesion::create([
          'nombre' => 'Pelvis',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      UbicacionLesion::create([
          'nombre' => 'Brazo',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      UbicacionLesion::create([
          'nombre' => 'Codo',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      UbicacionLesion::create([
      'nombre' => 'Antebrazo',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);

      UbicacionLesion::create([
      'nombre' => 'Muñeca',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);
      UbicacionLesion::create([
      'nombre' => 'Mano',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);
      UbicacionLesion::create([
      'nombre' => 'Dedos de la mano',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);

      UbicacionLesion::create([
      'nombre' => 'Región cervical',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);
      UbicacionLesion::create([
      'nombre' => 'Región dorsal',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);
      UbicacionLesion::create([
      'nombre' => 'Región lumbosacra',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);

      UbicacionLesion::create([
      'nombre' => 'Cadera',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);
      UbicacionLesion::create([
      'nombre' => 'Muslo',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);
      UbicacionLesion::create([
      'nombre' => 'Pierna',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);

      UbicacionLesion::create([
      'nombre' => 'Rodilla',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);
      UbicacionLesion::create([
      'nombre' => 'Tobillo',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);
      UbicacionLesion::create([
      'nombre' => 'Politrauma',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);

    }
}
