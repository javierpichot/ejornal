<?php

use App\Models\Empresa;
use App\Models\Trabajador;

use Carbon\Carbon;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class MegaflexSeeder extends Seeder
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
        'nombre' => 'Megaflex',
        'cuit' => '12345627890',
        'direccion' => 'Luis Maria Drago 1760 - Burzaco',
        'logo' => 'megaflex.png',
        'caducidad' => '2019-11-01',
        'created_at' => '2018-05-01 16:29:37'
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

      Trabajador::create([ 'nombre' => 'ABEL', 'apellido' => 'FORESTIER', 'documento' => '33782653', 'numero_legajo' => 'NULL', 'celular' => '1121594478', 'telefono' => '42994583', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ROBERTO', 'apellido' => 'OJEDA CESPEDES', 'documento' => '26883008', 'numero_legajo' => 'NULL', 'celular' => '1163326459', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GASTON', 'apellido' => 'SALUD', 'documento' => '29492044', 'numero_legajo' => '2011-02-11', 'celular' => '15365663', 'telefono' => '20778615', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'CARLOS', 'apellido' => 'ARGAÑARAZ', 'documento' => '22754291', 'numero_legajo' => '2006-08-01', 'celular' => '1165799898', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'SABRINA LAURA  ', 'apellido' => 'ACOSTA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'HORACIO  HORACIO', 'apellido' => 'ACUÑA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JUAN CARLOS', 'apellido' => 'ACUÑA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ARIEL RAMON', 'apellido' => 'AGUIAR', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'HUGO ALBERTO', 'apellido' => 'ALCARAZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'VENANCIO ARIEL', 'apellido' => 'ALVAREDO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '3704507251', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'DANIEL DALMACIO', 'apellido' => 'ALVAREZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'VICENTE PABLO', 'apellido' => 'AMADEY', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JULIO CESAR', 'apellido' => 'AQUINO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'CARLOS ARNALDO', 'apellido' => 'ARGAÑARAZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ANGEL ABEL', 'apellido' => 'ARTIGUE', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1148896067', 'telefono' => '42338809', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'FABIO OSCAR', 'apellido' => 'AVALLE', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MARCELO EZEQUIEL', 'apellido' => 'BAGNATI', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'CHRISTIAN', 'apellido' => 'BAJO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JULIO CESAR', 'apellido' => 'BALLESTERO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'INES MABEL  ', 'apellido' => 'BARRERA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'SEBASTIAN HECTOR  ', 'apellido' => 'BAZZI', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'CARLOS MARCELO', 'apellido' => 'BENAVIDEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ENZO   ', 'apellido' => 'BENITEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'FRANCISCO JAVIER', 'apellido' => 'BENITEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'LUCAS ALBERTO', 'apellido' => 'BENITEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MIGUEL ANGEL  ', 'apellido' => 'BERNACHEA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GUSTAVO   ', 'apellido' => 'BERNARDO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'HUGO ARIEL', 'apellido' => 'BERTO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1531036485', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'EMMANUEL MAXIMIANO  ', 'apellido' => 'BOIDI', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MARTIN ALEJANDRO  ', 'apellido' => 'BOLEGGI', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'NATALIA LORENA', 'apellido' => 'BOROJOVICH', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1533861564', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'FLAVIO GABRIEL', 'apellido' => 'BRACCO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'AQUINO DIONISIO  ', 'apellido' => 'BRACHO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GASTON MAXIMILIANO  ', 'apellido' => 'BRAVO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'CRISTIAN JAVIER', 'apellido' => 'CABRERA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MARIANO ANGEL  ', 'apellido' => 'CAMAYA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'CARLITOS DAMIAN', 'apellido' => 'CAMPOS', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'DANIEL OMAR', 'apellido' => 'CAMPOS', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1568079353', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ALEJANDRO   ', 'apellido' => 'CAÑETE', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'OSVALDO RICARDO  ', 'apellido' => 'CAÑETE', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'WALTER OMAR  ', 'apellido' => 'CAÑETE', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'FERNANDO ANDRES', 'apellido' => 'CARABAJAL', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MARIO CARLOS  ', 'apellido' => 'CARNEVALINI', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GUILLERMO MIGUEL', 'apellido' => 'CARO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1540230269', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'HECTOR LEONARDO', 'apellido' => 'CARO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'PAMELA VANESA  ', 'apellido' => 'CASADO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'RENZO', 'apellido' => 'CASARINI', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'CARLOS ARIEL', 'apellido' => 'CHAVEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JUAN ALBERTO  ', 'apellido' => 'CHAVEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MARIANO GABRIEL', 'apellido' => 'CHMIELEVSKY', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1130414244', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'LUCAS   ', 'apellido' => 'CICARELLO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'DIEGO JOSE', 'apellido' => 'COLL', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'SEBASTIAN JAVIER  ', 'apellido' => 'CORONEL', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'DOMINGO JAVIER  ', 'apellido' => 'COSTANTINO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ANTONIO   ', 'apellido' => 'CUEVAS', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'CARLOS ALBERTO  ', 'apellido' => 'CUEVAS', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'FRANCISCO   ', 'apellido' => 'CUEVAS', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'LEANDRO MIGUEL  ', 'apellido' => 'D`ALOIA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JOSE LUIS  ', 'apellido' => 'D´ANTONIO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'SILVA IVAN DAVID ', 'apellido' => 'DA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'BENEDETTI SAMANTA CORA ', 'apellido' => 'DE', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JORGE LEONEL', 'apellido' => 'DELBOY', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GIOSSO LUCAS  ', 'apellido' => 'DIAZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ISMAEL CESAR  ', 'apellido' => 'DIAZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MARCELO GUSTAVO  ', 'apellido' => 'DIAZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'WALTER NICOLAS  ', 'apellido' => 'DIAZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'PRISCILA ANTONELLA  ', 'apellido' => 'DITATA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JUAN FABIAN  ', 'apellido' => 'DUARTE', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GUILLERMO RAMON  ', 'apellido' => 'DURAN', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ROBERTO ARNALDO  ', 'apellido' => 'ENCINA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ARIEL LEONARDO  ', 'apellido' => 'ESCOBAR', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GERARDO ANTONIO  ', 'apellido' => 'ESCOBAR', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MIGUEL ANGEL  ', 'apellido' => 'ESCOBAR', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'OSCAR FABIAN  ', 'apellido' => 'ESCOBAR', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'SERGIO AGUSTIN  ', 'apellido' => 'ESCOBAR', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GABRIEL', 'apellido' => 'ESPINOSA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1133275772', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JONATAN DAVID  ', 'apellido' => 'ESPINOZA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'AGUSTIN ALEJANDRO', 'apellido' => 'FARINELLI', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1165861636', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'DANIEL ALEJANDRO  ', 'apellido' => 'FELSINGER', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'SANDRA   ', 'apellido' => 'FERNANDEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GERARDO JOSE  ', 'apellido' => 'FERRARI', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'LUCAS   ', 'apellido' => 'FERREIRA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JUAN IGNACIO  ', 'apellido' => 'FERRERAS', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'EMILIANO JUAN', 'apellido' => 'FETTE', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1130261507', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'LAUREANO VALENTIN  ', 'apellido' => 'FIGUEROA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'OSCAR EZEQUIEL  ', 'apellido' => 'FIGUEROA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'CARLOS PASCUAL  ', 'apellido' => 'FIORENZA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MARIA LAURA  ', 'apellido' => 'FLECHA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'EMANUEL DOMINGO  ', 'apellido' => 'FLORENTIN', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ABEL JUAN PABLO', 'apellido' => 'FORESTIER', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MENEZES ENIO CLAUDIO ', 'apellido' => 'FORTES', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'DIONISIO RUBEN  ', 'apellido' => 'GALAN', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MARIANO   ', 'apellido' => 'GALAN', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'NESTOR FABIAN', 'apellido' => 'GALDINI', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1526287816', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JORGE IGNACIO  ', 'apellido' => 'GALPARSORO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ANTONIO LIBRADO  ', 'apellido' => 'GARCIA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'LEANDRO ARIEL  ', 'apellido' => 'GIMENEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'PABLO ARIEL  ', 'apellido' => 'GODOY', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ALEJANDRO SEBASTIAN  ', 'apellido' => 'GOMEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'DARIO JAVIER  ', 'apellido' => 'GOMEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JORGE LUIS', 'apellido' => 'GOMEZ', 'documento' => '33942146', 'numero_legajo' => 'NULL', 'celular' => '1164471554', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'RUBEN   ', 'apellido' => 'GOMEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ARIEL ALBERTO  ', 'apellido' => 'GONZALEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JUAN PABLO', 'apellido' => 'GONZALEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1154633947', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ROXANA MABEL  ', 'apellido' => 'GONZALEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MAXIMILIANO EZEQUIEL  ', 'apellido' => 'GORALCZUK', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GUSTAVO ANGEL  ', 'apellido' => 'GRASSI', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'RAMON RICARDO  ', 'apellido' => 'GUERRERO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'CRISTIAN RUBEN', 'apellido' => 'HEREDIA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'VARGAS FERNANDO ADRIAN ', 'apellido' => 'HERMOSA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ARIEL DAMIAN AGUSTIN', 'apellido' => 'HERRERA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1546731989', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JAVIER   ', 'apellido' => 'HERRERA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GABRIEL EMILIO  ', 'apellido' => 'HOLOWINSKI', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MAURO AMILCAR  ', 'apellido' => 'HUMAN', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ANGEL ALCIDES  ', 'apellido' => 'IBARRA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'APOLINARIO RAMON  ', 'apellido' => 'IBARRA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'DONATO RAUL  ', 'apellido' => 'IBARRA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MARIA LAURA  ', 'apellido' => 'JAUREGUI', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JUAN MANUEL  ', 'apellido' => 'JIMENEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'LUCRECIA EVA  ', 'apellido' => 'JUAREZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MARIA EVA  ', 'apellido' => 'JUEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'WALTER DARIO  ', 'apellido' => 'KOTAS', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'PABLO   ', 'apellido' => 'LARRIGAUDIERE', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'TIAGO   ', 'apellido' => 'LEITE', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ROBERTO VICTOR  ', 'apellido' => 'LEMIEZA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GOMEZ CRISTIAN ALBERTO ', 'apellido' => 'LIMA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'RICARDO FLORENCIO  ', 'apellido' => 'LOAIZA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'CINTIA   ', 'apellido' => 'LOBOS', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ALEJANDRO   ', 'apellido' => 'LOPEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JAVIER   ', 'apellido' => 'LOPEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ANGEL ALBERTO  ', 'apellido' => 'MACIEL', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GREGORIO ROBERTO  ', 'apellido' => 'MAIDANA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GUSTAVO ANDRES  ', 'apellido' => 'MALDONADO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MARTINEZ CRISTIAN  ', 'apellido' => 'MALTRAS', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MARCELO CELSO  ', 'apellido' => 'MARMOL', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'OMAR FERNANDO EXEQUI', 'apellido' => 'MEDINA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1128855626', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'WALTER RAFAEL', 'apellido' => 'MELIAN', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1158893799', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JORGE OSCAR', 'apellido' => 'MENDOZA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1169038888', 'telefono' => '42191084', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'DIEGO GUSTAVO  ', 'apellido' => 'MEZA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'DANIEL ALBERTO  ', 'apellido' => 'MIRANDA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'HERNAN FEDERICO  ', 'apellido' => 'MOJICA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'RICARDO ANDRES  ', 'apellido' => 'MONGELOS', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GANDARILLAS JOSE', 'apellido' => 'MONTAÑO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1123703401', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MIRNA ELIZABETH  ', 'apellido' => 'MORA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GASTON EZEQUIEL  ', 'apellido' => 'MORALES', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'PABLO   ', 'apellido' => 'MORAN', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ANTONIO OSVALDO  ', 'apellido' => 'MORENO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'HECTOR ADRIAN  ', 'apellido' => 'MORENO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MIGUEL ANGEL  ', 'apellido' => 'MOREYRA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'NESTOR EMANUEL  ', 'apellido' => 'MOSEGUE', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'HUGO ABEL  ', 'apellido' => 'MUÑOZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ARIEL MARIANO  ', 'apellido' => 'NICOLINI', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'FAVIO ANSELMO  ', 'apellido' => 'NUÑEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'FERNANDO DANIEL  ', 'apellido' => 'NUÑEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JONATAN', 'apellido' => 'NUÑEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1154012988', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MAURO   ', 'apellido' => 'NUÑEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MIGUEL ANTONIO  ', 'apellido' => 'NUÑEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JOSE LUIS  ', 'apellido' => 'OBREGON', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'PABLO JAVIER  ', 'apellido' => 'OBREGON', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'NELSON JAVIER  ', 'apellido' => 'OCAMPO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JUAN CARLOS  ', 'apellido' => 'OJEDA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'SERGIO   ', 'apellido' => 'OJEDA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JUAN SEBASTIAN  ', 'apellido' => 'ORTIZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'NELSON ALEJANDRO  ', 'apellido' => 'OVEJERO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GUSTAVO SERGIO  ', 'apellido' => 'PAGURA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GABRIEL HUGO', 'apellido' => 'PALLARES', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'RUBEN DARIO  ', 'apellido' => 'PALMAS', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MARIO ANTONIO  ', 'apellido' => 'PEREZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'NATALIA ROMINA', 'apellido' => 'POZA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'AYELEN ELIZABET  ', 'apellido' => 'POZZI', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'RAMON RICARDO  ', 'apellido' => 'PRIETO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'LEONEL GASTON', 'apellido' => 'QUINTANA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1155674585', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MAXIMILIANO GUILLERMO  ', 'apellido' => 'RAIMONDI', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'DIEGO OSCAR  ', 'apellido' => 'RAMIREZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JUAN DOMINGO  ', 'apellido' => 'RAMIREZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JUAN MAXIMILIANO  ', 'apellido' => 'RAMIREZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ROBERTO SERGIO  ', 'apellido' => 'RAMIREZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'FERNANDO   ', 'apellido' => 'REBICH', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'LEONARDO   ', 'apellido' => 'RECALDE', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ANA CAROLINA  ', 'apellido' => 'RICABARRA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ROBERTO CARLOS  ', 'apellido' => 'RIOS', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'FRANCO EMANUEL  ', 'apellido' => 'RIVAROLA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GASTON   ', 'apellido' => 'RIVERO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'FABIAN ENRIQUE  ', 'apellido' => 'RODRIGUEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ANDRES FABIAN  ', 'apellido' => 'ROLON', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'NESTOR EZEQUIEL  ', 'apellido' => 'ROLON', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MIGUEL ANGEL  ', 'apellido' => 'ROMAN', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ALEJANDRO   ', 'apellido' => 'ROMERO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'BENJAMIN MAXIMILIANO', 'apellido' => 'ROMERO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1153891825', 'telefono' => '42300739', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'HUGO ARIEL', 'apellido' => 'ROMERO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JUAN CARLOS  ', 'apellido' => 'ROMERO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'DIAZ MAURO ABEL ', 'apellido' => 'RUIZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GASTON EMANUEL', 'apellido' => 'SALUD', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1536567663', 'telefono' => '20778615', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'NATANIEL MARTIN', 'apellido' => 'SANCHEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'REMIGIO DE JESUS ', 'apellido' => 'SANCHEZ', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JUAN ANTONIO  ', 'apellido' => 'SANCOFF', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MANUEL EDGARDO  ', 'apellido' => 'SANCOFF', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'COLOMA BEN JOSE FRANCISCO', 'apellido' => 'SANTA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'DARIO   ', 'apellido' => 'SANTAGATI', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'FAUSTINO ROBERTO  ', 'apellido' => 'SENA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'RAMON CLEMENTE  ', 'apellido' => 'SENA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'RAMON IGNACIO  ', 'apellido' => 'SENA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GONZALEZ JOSE IGNACIO ', 'apellido' => 'SILVA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'WALTER GABRIEL  ', 'apellido' => 'SIPAG', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'DEL CARRIL LUIS GUSTAVO', 'apellido' => 'SIVORI', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'NINO   ', 'apellido' => 'SONCO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'RAMON ORLANDO  ', 'apellido' => 'SORIA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ISIDRO ADRIAN  ', 'apellido' => 'SOSA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'SEBASTIAN LEONARDO  ', 'apellido' => 'STERLICCO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ESTEBAN CARLOS  ', 'apellido' => 'SUDROT', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JONATAN JULIO  ', 'apellido' => 'SUGASTTI', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GUSTAVO ARIEL  ', 'apellido' => 'THEA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JULIO ALBERTO  ', 'apellido' => 'TOLEDO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ANDRES JAVIER  ', 'apellido' => 'UMERE', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'FERNANDO FABIAN  ', 'apellido' => 'UTRERA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MARCOS ANDRES  ', 'apellido' => 'VACA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ANGEL GABRIEL', 'apellido' => 'VALLEJO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'HECTOR LEANDRO', 'apellido' => 'VALLEJO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'RAMON ISABELINO', 'apellido' => 'VALLEJO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'HECTOR OMAR', 'apellido' => 'VALLEJOS', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MELINA', 'apellido' => 'VARELA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'ALEJANDRO', 'apellido' => 'VEGA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'MARCELO', 'apellido' => 'VERGES', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'DANIEL GUSTAVO', 'apellido' => 'VERON', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'RAMON MANUEL', 'apellido' => 'VERON', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'CESAR SEBASTIAN', 'apellido' => 'VILLAMAYOR', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => '1564272664', 'telefono' => '2224421805', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'BLAS FELIPE', 'apellido' => 'VILLORDO', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'BERNARDO DANIEL', 'apellido' => 'VINITZCA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'EDGARDO SALOMON', 'apellido' => 'WELLER', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'GONZALEZ MARTIN EZEQUIEL', 'apellido' => 'ZAYAS', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JUAN IGNACIO', 'apellido' => 'ZBINDEN', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'CRISTIAN SANTIAGO', 'apellido' => 'ZEBALLOS', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'BELEN', 'apellido' => 'GRANDE', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 
Trabajador::create([ 'nombre' => 'JONATAN DAVID', 'apellido' => 'ESPINOSA', 'documento' => 'NULL', 'numero_legajo' => 'NULL', 'celular' => 'NULL', 'telefono' => 'NULL', 'empresa_id' => '3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]); 


    }
}
