<?php

use Illuminate\Database\Seeder;

class CreateTipoTareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\TipoTarea::create([
            'nombre' => 'Puntual',
        ]);


        \App\Models\TipoTarea::create([
            'nombre' => 'Diaria',
        ]);

        \App\Models\TipoTarea::create([
            'nombre' => 'Mensual',
        ]);

        \App\Models\TipoTarea::create([
            'nombre' => 'Por turno',
        ]);

    }
}
