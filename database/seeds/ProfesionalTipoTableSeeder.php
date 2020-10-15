<?php

use Illuminate\Database\Seeder;
use App\Models\ProfesionalTipo;
use App\Models\Profesional;


use Carbon\Carbon;
class ProfesionalTipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     ProfesionalTipo::create([
          'nombre' => 'Medico',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      ProfesionalTipo::create([
          'nombre' => 'Enfermera/o',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      ProfesionalTipo::create([
          'nombre' => 'Auxiliar enfermeria',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      ProfesionalTipo::create([
          'nombre' => 'Kinesiologo',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);

      $profesional = Profesional::create([
          'profesional_tipo_id' => '1',
          'user_id' => '1',
          'nombre' => 'Nicolás',
          'apellido' => 'Benito Arango',
          'documento' => '94870499',
          'email' => 'nbenitoarango@gmail.com',
          'celular' => '1137870294',
          'photo' => 'niko.jpg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      $profesional = Profesional::create([
          'profesional_tipo_id' => '2',
          'user_id' => '4',
          'nombre' => 'Gerardo',
          'apellido' => 'Iriarte',
          'documento' => '23423',
          'email' => 'gerardo_iriarte@ejornal.com.ar',
          'celular' => '1159624548',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      $profesional = Profesional::create([
          'profesional_tipo_id' => '2',
          'user_id' => '5',
          'nombre' => 'Patricia',
          'apellido' => 'Viollaz',
          'documento' => '223423',
          'email' => 'patri_viollaz@ejornal.com.ar',
          'celular' => '1122894182',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      $profesional = Profesional::create([
          'profesional_tipo_id' => '2',
          'user_id' => '5',
          'nombre' => 'Pedro',
          'apellido' => 'Escobar',
          'documento' => '2314223',
          'email' => 'pedro_escobar@ejornal.com.ar',
          'celular' => '1141611380',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      $profesional = Profesional::create([
          'profesional_tipo_id' => '2',
          'user_id' => '4',
          'nombre' => 'Viviana',
          'apellido' => 'Semecurbe',
          'documento' => '123423',
          'email' => 'vivi_semecurbe@ejornal.com.ar',
          'celular' => '1134690416',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
 $profesional = Profesional::create([
          'profesional_tipo_id' => '1',
          'user_id' => '14',
          'nombre' => 'Federico',
          'apellido' => 'Forte',
          'documento' => '9999999',
          'email' => 'federico_fortte@ejornal.online',
          'celular' => '123123',
          'photo' => 'federico_fortte.jpg',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
    }
}
