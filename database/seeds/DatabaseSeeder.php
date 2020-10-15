<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        


        $this->call(PrestacionDrogaTipoSeeder::class);

        $this->call(TestSeeder::class);
        $this->call(CarrefourSeeder::class);
        $this->call(MegaflexSeeder::class);
        $this->call(WallmartSeeder::class);
        $this->call(IsoverSeeder::class);
        $this->call(DisprofarmaSeeder::class);
        $this->call(WeberSeeder::class);
        $this->call(ObraSocialSeeder::class);
        $this->call(AgenteRiesgoSeeder::class);
        $this->call(EspecialidadDiagnosticoSeeder::class);
        $this->call(UsersRolesTableSeeder::class);


        $this->call(UserTableSeeder::class);
        $this->call(FormaAccidenteTableSeeder::class);
        $this->call(ProfesionalTipoTableSeeder::class);
        $this->call(TipoLesionTableSeeder::class);
        $this->call(UbicacionLesionTableSeeder::class);
        $this->call(RevisionPeriodicaTipoTableSeeder::class);
  
        $this->call(CreateTipoTareaSeeder::class);
        

    }
}
