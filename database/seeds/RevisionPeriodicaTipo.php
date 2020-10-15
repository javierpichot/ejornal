<?php

use Illuminate\Database\Seeder;
use App\Models\RevisionPeriodicaTipo;


use Carbon\Carbon;

class RevisionPeriodicaTipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      RevisionPeriodicaTipo::create([
      'nombre' => 'Limpieza',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);
      RevisionPeriodicaTipo::create([
      'nombre' => 'Mantenimiento',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);
      RevisionPeriodicaTipo::create([
      'nombre' => 'Reparación',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);

      }
}
