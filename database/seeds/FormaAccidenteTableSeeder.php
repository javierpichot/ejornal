<?php

use Illuminate\Database\Seeder;
use App\Models\FormaAccidente;


use Carbon\Carbon;

class FormaAccidenteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      FormaAccidente::create([
      'nombre' => 'Caida de objetos',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);
      FormaAccidente::create([
      'nombre' => 'Caida de personas',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);
     FormaAccidente::create([
      'nombre' => 'Pisada, choque contra o golpeado por',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);
      FormaAccidente::create([
      'nombre' => 'Atrapamiento por o entre objetos',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);
      FormaAccidente::create([
      'nombre' => 'Esfuerzos excesivos',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);
      FormaAccidente::create([
      'nombre' => 'Exposición a, o contacto con correinte electrica',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);
      FormaAccidente::create([
      'nombre' => 'Exposición a, o contacto con temperaturas extremas',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);

     FormaAccidente::create([
      'nombre' => 'Exposición a, o contacto con sustancias nocivas o radiaciones',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      ]);
    }
}
