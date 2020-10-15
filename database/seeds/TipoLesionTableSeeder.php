<?php

use Illuminate\Database\Seeder;
use App\Models\TipoLesion;


use Carbon\Carbon;

class TipoLesionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      TipoLesion::create([
          'nombre' => 'Escoriaciones',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      TipoLesion::create([
          'nombre' => 'Heridas punzantes',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      TipoLesion::create([
          'nombre' => 'Heridas cortantes',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      TipoLesion::create([
          'nombre' => 'Heridas contusas/anfractuosas',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      TipoLesion::create([
          'nombre' => 'Contunsiones',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      TipoLesion::create([
          'nombre' => 'Traumatismos',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      TipoLesion::create([
          'nombre' => 'Amputaciones',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);
      TipoLesion::create([
          'nombre' => 'Quemadura',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
      ]);

    }
}
