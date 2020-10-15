<?php

use App\Models\Empresa;
use App\Models\Trabajador;

use Carbon\Carbon;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class WeberSeeder extends Seeder
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
                  'nombre' => 'Weber',
                  'cuit' => '12234526723890',
                  'direccion' => 'Camino de la gominola 2400',
                  'logo' => 'weber.png',

                  'caducidad' => '2019-11-01',
                  'created_at' => '2018-05-01 16:29:37'
              ]);


      //                    tarea                     //

      $empresa->tarea()->create([
          'nombre' => 'Gerente'
      ]);

      $empresa->tarea()->create([
          'nombre' => 'Secretaria'
      ]);
      $empresa->tarea()->create([
          'nombre' => 'Supervisor'
      ]);

      $empresa->tarea()->create([
          'nombre' => 'Analista'
      ]);
      $empresa->tarea()->create([
          'nombre' => 'Director'
      ]);

      $empresa->tarea()->create([
          'nombre' => 'Subdirector'
      ]);
      $empresa->tarea()->create([
          'nombre' => 'Responsable'
      ]);

      $empresa->tarea()->create([
          'nombre' => 'Auxiliar'
      ]);
      $empresa->tarea()->create([
          'nombre' => 'Ejecutivo ventas'
      ]);

      $empresa->tarea()->create([
          'nombre' => 'Asistente gerencial'
      ]);
      $empresa->tarea()->create([
          'nombre' => 'Administrativo'
      ]);

      $empresa->tarea()->create([
          'nombre' => 'Jefe'
      ]);
      $empresa->tarea()->create([
          'nombre' => 'Operario'
      ]);
      $empresa->tarea()->create([
          'nombre' => 'Arquitecto'
      ]);

      $empresa->tarea()->create([
          'nombre' => 'Operario lider'
      ]);
      $empresa->tarea()->create([
          'nombre' => 'Enfermero'
      ]);
      $empresa->tarea()->create([
          'nombre' => 'Abogado'
      ]);
      $empresa->tarea()->create([
          'nombre' => 'Coordinador'
      ]);
      $empresa->tarea()->create([
          'nombre' => 'Técnico'
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

      $empresa->sector()->create([
          'nombre' => 'GERENCIA GENERAL'
      ]);
      $empresa->sector()->create([
          'nombre' => 'GERENCIA DE AUDITORIA INTERNA'
      ]);
      $empresa->sector()->create([
          'nombre' => 'GERENCIA DE CALIDAD'
      ]);
      $empresa->sector()->create([
          'nombre' => 'GERENCIA AREA COMERCIAL'
      ]);
      $empresa->sector()->create([
          'nombre' => 'GERENCIA INGENIERIA INTENDENCIA Y MANTENIMIENTO'
      ]);
      $empresa->sector()->create([
          'nombre' => 'GERENCIA DE PRODUCCION'
      ]);
      $empresa->sector()->create([
          'nombre' => 'GERENCIA DE  LOGISTICA'
      ]);
      $empresa->sector()->create([
          'nombre' => 'DEPARTAMENTO COORDINAC Y CTROL'
      ]);
      $empresa->sector()->create([
          'nombre' => 'GERENCIA AREA RECURSOS HUMANOS '
      ]);
      $empresa->sector()->create([
          'nombre' => 'GERENCIA AREA ADMINISTRACION,  FINANZAS E INFORMACION Y TECNOLOGIA'
      ]);
      $empresa->sector()->create([
          'nombre' => 'GERENCIA INFORMACION Y TECNOLOGIA'
      ]);
      $empresa->sector()->create([
          'nombre' => 'GERENCIA DE FINANZAS'
      ]);
      Trabajador::create([ 'nombre' => ' DANIEL COSME', 'apellido' => 'ACUÑA', 'documento' => '25245528', 'numero_legajo' => '379', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JORGE ALFREDO', 'apellido' => 'AERTS', 'documento' => '29631369', 'numero_legajo' => '1344', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' RICARDO A.', 'apellido' => 'ALEGRE', 'documento' => '26578531', 'numero_legajo' => '250', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' WALTER ROBERTO', 'apellido' => 'ALEGRE', 'documento' => '25435507', 'numero_legajo' => '1090', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ANTONIO MARTIN', 'apellido' => 'ALLENDE VENENCIA', 'documento' => '33701749', 'numero_legajo' => '890', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MANUEL LUIS', 'apellido' => 'ALONSO', 'documento' => '13464152', 'numero_legajo' => '224', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' PABLO JAVIER', 'apellido' => 'ALVAREZ', 'documento' => '29371488', 'numero_legajo' => '638', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' FABIO HENRIQUE', 'apellido' => 'ALVIM DE AZEVEDO', 'documento' => '95862838', 'numero_legajo' => '1444', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JESUS DANIEL', 'apellido' => 'AMADO', 'documento' => '33710314', 'numero_legajo' => '508', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' FATIMA NOEMI', 'apellido' => 'AMARILLA', 'documento' => '37945726', 'numero_legajo' => '1499', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MIGUEL ANGEL', 'apellido' => 'AMARILLA', 'documento' => '24122143', 'numero_legajo' => '1372', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' EMILIANO RAUL', 'apellido' => 'AMAYA', 'documento' => '26205219', 'numero_legajo' => '873', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' GUSTAVO JAVIER', 'apellido' => 'ANDRADA', 'documento' => '22195318', 'numero_legajo' => '230', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' VIVIANA ROSA', 'apellido' => 'ANGUILANTE', 'documento' => '23431310', 'numero_legajo' => '181', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' LETICIA', 'apellido' => 'AQUINO', 'documento' => '28649390', 'numero_legajo' => '395', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ANDREA GISELA', 'apellido' => 'AROCENA', 'documento' => '31553885', 'numero_legajo' => '963', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' LUIS DANIEL', 'apellido' => 'AUTEDO GUERRA', 'documento' => '94283319', 'numero_legajo' => '1290', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' LEANDRO NICOLAS', 'apellido' => 'AVALOS', 'documento' => '34081110', 'numero_legajo' => '749', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARIA FERNANDA', 'apellido' => 'BADELL', 'documento' => '34866224', 'numero_legajo' => '1553', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' PABLO DAVID', 'apellido' => 'BALLESTER', 'documento' => '28457415', 'numero_legajo' => '217', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ALBERTO RAFAEL', 'apellido' => 'BALMACEDA', 'documento' => '34501464', 'numero_legajo' => '736', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' DANIELA BELEN', 'apellido' => 'BARCIA', 'documento' => '40475327', 'numero_legajo' => '1576', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' DANIELA SOLEDAD', 'apellido' => 'BARRIONUEVO', 'documento' => '36090684', 'numero_legajo' => '1495', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' NATALIA MARIANA', 'apellido' => 'BARRIOS OTERO', 'documento' => '32651161', 'numero_legajo' => '440', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' NOELIA MAGALI', 'apellido' => 'BASILE', 'documento' => '38561579', 'numero_legajo' => '1002', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ADRIAN NORBERTO', 'apellido' => 'BASUALDO', 'documento' => '20693497', 'numero_legajo' => '172', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARCOS FABIAN', 'apellido' => 'BATALLA', 'documento' => '30931847', 'numero_legajo' => '1578', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' AGUSTIN FARID', 'apellido' => 'BAZZE', 'documento' => '41352345', 'numero_legajo' => '1490', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' FRANCO DAVID', 'apellido' => 'BECERRA', 'documento' => '35203929', 'numero_legajo' => '1348', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ALEJANDRO LUIS', 'apellido' => 'BELCASTRO', 'documento' => '21507565', 'numero_legajo' => '187', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARTIN', 'apellido' => 'BENCHOA', 'documento' => '21425289', 'numero_legajo' => '320', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MANUEL', 'apellido' => 'BENITEZ MORA', 'documento' => '33786061', 'numero_legajo' => '937', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' BERNARDO DAMIAN', 'apellido' => 'BENOIT', 'documento' => '20734002', 'numero_legajo' => '592', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' PAULA', 'apellido' => 'BERMUDEZ', 'documento' => '26562500', 'numero_legajo' => '281', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' VICENTE SATURNINO', 'apellido' => 'BERON', 'documento' => '10965881', 'numero_legajo' => '242', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ANDRES', 'apellido' => 'BIAGETTI', 'documento' => '32278657', 'numero_legajo' => '553', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' PAULA', 'apellido' => 'BIGLIERI', 'documento' => '35228649', 'numero_legajo' => '1091', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARCOS ARIEL', 'apellido' => 'BILOTTI', 'documento' => '27780789', 'numero_legajo' => '473', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MATIAS LUIS', 'apellido' => 'BOCCIONI', 'documento' => '30943103', 'numero_legajo' => '706', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' DIEGO JAVIER', 'apellido' => 'BORDA', 'documento' => '27806946', 'numero_legajo' => '1317', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' RODRIGO ENRIQUE', 'apellido' => 'BORRAS', 'documento' => '21441336', 'numero_legajo' => '420', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' GERMÁN', 'apellido' => 'BRATT BRIZUELA', 'documento' => '31088738', 'numero_legajo' => '917', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' PABLO GABRIEL', 'apellido' => 'BRAVO', 'documento' => '24502754', 'numero_legajo' => '252', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JORGE ERNESTO EZEQUIEL', 'apellido' => 'BRUNI', 'documento' => '31784218', 'numero_legajo' => '737', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' DAIANA ALEXIA', 'apellido' => 'BUSTAMANTE SANDOVAL', 'documento' => '36365419', 'numero_legajo' => '1497', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JAVIER FERNANDO', 'apellido' => 'BUSTAMANTE', 'documento' => '35632806', 'numero_legajo' => '712', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' HORACIO ANDRES', 'apellido' => 'CABRAL', 'documento' => '27375092', 'numero_legajo' => '575', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ESTEBAN EDUARDO', 'apellido' => 'CABRERA', 'documento' => '36440157', 'numero_legajo' => '1062', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JUAN ESTEBAN', 'apellido' => 'CACERES', 'documento' => '26079543', 'numero_legajo' => '850', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARIA CARMELO', 'apellido' => 'CAIRE', 'documento' => '12478110', 'numero_legajo' => '156', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' GUSTAVO HERNAN RAMON', 'apellido' => 'CANCINO', 'documento' => '25245532', 'numero_legajo' => '329', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MATIAS DANIEL', 'apellido' => 'CANTEROS', 'documento' => '33840947', 'numero_legajo' => '718', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' HERNANDO ANDRES', 'apellido' => 'CAREAGA', 'documento' => '28569558', 'numero_legajo' => '383', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' LEONARDO FABIAN', 'apellido' => 'CASCO', 'documento' => '35758041', 'numero_legajo' => '943', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' DAVID AGUSTIN', 'apellido' => 'CASTILLO', 'documento' => '29932143', 'numero_legajo' => '768', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' EMILIANO EDUARDO', 'apellido' => 'CASTILLO', 'documento' => '33286419', 'numero_legajo' => '644', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JONATHAN NICOLAS', 'apellido' => 'CASTILLO', 'documento' => '36065238', 'numero_legajo' => '738', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JULIAN HORACIO', 'apellido' => 'CASTRO', 'documento' => '26803050', 'numero_legajo' => '1088', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' HERNAN ALBERTO', 'apellido' => 'CHOQUE', 'documento' => '31581488', 'numero_legajo' => '1318', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' PABLO ADRIAN', 'apellido' => 'CLAUDE', 'documento' => '30527525', 'numero_legajo' => '984', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' DIEGO ANDRES', 'apellido' => 'CLOSTER', 'documento' => '26542780', 'numero_legajo' => '858', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' LUCIANO JORGE', 'apellido' => 'COLOMBO', 'documento' => '24870110', 'numero_legajo' => '526', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' SANTIAGO ARIEL', 'apellido' => 'COLQUE', 'documento' => '37542286', 'numero_legajo' => '951', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MATIAS EZEQUIEL', 'apellido' => 'CONTRERAS', 'documento' => '33466295', 'numero_legajo' => '570', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MIGUEL ANGEL', 'apellido' => 'CONTRERAS', 'documento' => '31480092', 'numero_legajo' => '573', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' DAMIAN HORACIO', 'apellido' => 'CORDOBA', 'documento' => '33490103', 'numero_legajo' => '1233', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' BRUNO GERARDO', 'apellido' => 'CORTESE', 'documento' => '40880335', 'numero_legajo' => '1575', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARIO', 'apellido' => 'COSTANTINI', 'documento' => '16243318', 'numero_legajo' => '705', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JONATHAN GABRIEL', 'apellido' => 'COUSO', 'documento' => '35092829', 'numero_legajo' => '1282', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ROMAN EMMANUEL', 'apellido' => 'CUELLO', 'documento' => '30112970', 'numero_legajo' => '535', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ESTEBAN A.', 'apellido' => 'DAVERSA', 'documento' => '18397287', 'numero_legajo' => '153', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' LUCIA', 'apellido' => 'DE LA BARRA', 'documento' => '23329420', 'numero_legajo' => '382', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JORGE MAXIMILIANO', 'apellido' => 'DEL HOYO', 'documento' => '30279358', 'numero_legajo' => '950', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JOSE LUIS', 'apellido' => 'DELGADO', 'documento' => '33033500', 'numero_legajo' => '661', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARIA BELEN', 'apellido' => 'DIAZ RODRIGUEZ', 'documento' => '35146995', 'numero_legajo' => '861', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' GUILLERMO FABIAN', 'apellido' => 'DOMINGUEZ', 'documento' => '24149557', 'numero_legajo' => '1234', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' SILVIA MABEL', 'apellido' => 'DOMINGUEZ', 'documento' => '20766152', 'numero_legajo' => '147', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' PABLO ANIBAL', 'apellido' => 'DOTTO', 'documento' => '32401862', 'numero_legajo' => '949', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' GUSTAVO DANIEL', 'apellido' => 'DOVAL', 'documento' => '32641621', 'numero_legajo' => '994', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' CLAUDIO ANDRES', 'apellido' => 'DUARTE', 'documento' => '22844125', 'numero_legajo' => '323', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' CAMILA AILEN', 'apellido' => 'ELISEI', 'documento' => '41876097', 'numero_legajo' => '1564', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' CARLOS ALBERTO', 'apellido' => 'EMERI', 'documento' => '17409633', 'numero_legajo' => '219', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARCELO DANIEL', 'apellido' => 'ESCOBAR', 'documento' => '30138252', 'numero_legajo' => '660', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' SERGIO DAMIAN', 'apellido' => 'ESCOBEDO', 'documento' => '32964275', 'numero_legajo' => '1074', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' SERGIO DARIO', 'apellido' => 'ESCUDEIRO', 'documento' => '26618380', 'numero_legajo' => '953', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARCELO OSCAR', 'apellido' => 'ESPARZA', 'documento' => '12975753', 'numero_legajo' => '237', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' DIEGO ROBERTO', 'apellido' => 'FALCON', 'documento' => '29460753', 'numero_legajo' => '990', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' RODRIGO', 'apellido' => 'FERNANDES BARROSO', 'documento' => '62937712', 'numero_legajo' => '1577', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' EDUARDO EMMANUEL', 'apellido' => 'FERNANDEZ', 'documento' => '36165391', 'numero_legajo' => '824', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARIA PILAR', 'apellido' => 'FERRANDO', 'documento' => '33397578', 'numero_legajo' => '1535', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' FERNANDO IGNACIO', 'apellido' => 'FERRARI', 'documento' => '32483455', 'numero_legajo' => '1567', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARIA ISABEL', 'apellido' => 'FERREYRA', 'documento' => '38787979', 'numero_legajo' => '1364', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' NICOLAS EZEQUIEL', 'apellido' => 'FLORIO', 'documento' => '29199622', 'numero_legajo' => '611', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' SOLANGE', 'apellido' => 'FONDATI', 'documento' => '34521787', 'numero_legajo' => '606', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' SABRINA VERONICA', 'apellido' => 'FONTE', 'documento' => '30957884', 'numero_legajo' => '474', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MIGUEL ROLANDO', 'apellido' => 'FRANCO', 'documento' => '31964374', 'numero_legajo' => '642', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JOSE ARIEL', 'apellido' => 'FREDES', 'documento' => '31303089', 'numero_legajo' => '1415', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' NICOLAS FEDERICO', 'apellido' => 'GABRIELE', 'documento' => '34154291', 'numero_legajo' => '1158', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' DIEGO ALEJANDRO', 'apellido' => 'GALVAN', 'documento' => '37180571', 'numero_legajo' => '1491', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' LUIS MATEO', 'apellido' => 'GARASSI', 'documento' => '10758153', 'numero_legajo' => '131', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' FABIAN CLAUDIO', 'apellido' => 'GARCIA', 'documento' => '20620603', 'numero_legajo' => '307', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' GABRIEL NORBERTO', 'apellido' => 'GARCIA', 'documento' => '24169346', 'numero_legajo' => '387', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' RODRIGO EZEQUIEL', 'apellido' => 'GARCIA', 'documento' => '36941302', 'numero_legajo' => '1087', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' RUBEN ALBERTO', 'apellido' => 'GARCIA', 'documento' => '14872660', 'numero_legajo' => '1275', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' LUCAS GABRIEL', 'apellido' => 'GHIZZO', 'documento' => '27748692', 'numero_legajo' => '1441', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => 'CARLOS DANIEL', 'apellido' => 'GIBERTONI', 'documento' => '14740656', 'numero_legajo' => '151', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ARIEL GERMAN', 'apellido' => 'GIMENEZ', 'documento' => '27753693', 'numero_legajo' => '273', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' SERGIO LUIS', 'apellido' => 'GIMENEZ', 'documento' => '28970075', 'numero_legajo' => '1035', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARCELO RENZO FRANCISC', 'apellido' => 'GIORLANDO RIVERA', 'documento' => '35426930', 'numero_legajo' => '905', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' LORENA', 'apellido' => 'GODINA', 'documento' => '27728517', 'numero_legajo' => '580', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' LUCIO ANDRES', 'apellido' => 'GODOY UGARTE', 'documento' => '94288389', 'numero_legajo' => '985', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' LEOPOLDO CARMEN', 'apellido' => 'GODOY', 'documento' => '26552801', 'numero_legajo' => '333', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ALEJO VLADIMIRO', 'apellido' => 'GOMEZ BARANOFF', 'documento' => '30460229', 'numero_legajo' => '1086', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' GONZALO EMMANUEL', 'apellido' => 'GOMEZ NEUVIRT', 'documento' => '35105669', 'numero_legajo' => '704', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' LUCAS MATIAS', 'apellido' => 'GOMEZ', 'documento' => '30047890', 'numero_legajo' => '1341', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' SEBASTIAN', 'apellido' => 'GONZALEZ BORDON', 'documento' => '33940114', 'numero_legajo' => '1371', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ALEJANDRO DAMIAN', 'apellido' => 'GONZALEZ', 'documento' => '36065205', 'numero_legajo' => '735', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' FEDERICO LEONARDO', 'apellido' => 'GONZALEZ', 'documento' => '38666725', 'numero_legajo' => '1573', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' GRACIELA SUSANA', 'apellido' => 'GONZALEZ', 'documento' => '23885154', 'numero_legajo' => '1039', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JORGE RODRIGO', 'apellido' => 'GONZALEZ', 'documento' => '27604561', 'numero_legajo' => '646', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JOSE ALBERTO', 'apellido' => 'GONZALEZ', 'documento' => '28285541', 'numero_legajo' => '436', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' NAHUEL EZEQUIEL', 'apellido' => 'GONZALEZ', 'documento' => '34649639', 'numero_legajo' => '1582', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' PAOLA ANDREA', 'apellido' => 'GONZALEZ', 'documento' => '29631756', 'numero_legajo' => '1037', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ALEJANDRO JAVIER PEDRO', 'apellido' => 'GOROHOLSKI', 'documento' => '36394470', 'numero_legajo' => '898', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' DIEGO JUAN OSCAR', 'apellido' => 'GUERREÑO', 'documento' => '34343960', 'numero_legajo' => '1054', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' FERNANDO EZEQUIEL', 'apellido' => 'GUIDETTO', 'documento' => '35335334', 'numero_legajo' => '1067', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' GONZALO MARTIN', 'apellido' => 'GUSMAN', 'documento' => '35671331', 'numero_legajo' => '1224', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JUAN MANUEL', 'apellido' => 'HENRICH PEINADO', 'documento' => '33716379', 'numero_legajo' => '1162', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' FABIAN ALEJANDRO', 'apellido' => 'HERMOSILLA', 'documento' => '18425016', 'numero_legajo' => '634', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARIO OSCAR', 'apellido' => 'HERRERA', 'documento' => '23035460', 'numero_legajo' => '186', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' DIEGO EZEQUIEL', 'apellido' => 'HIGA', 'documento' => '22824192', 'numero_legajo' => '328', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' HERNAN CLAUDIO', 'apellido' => 'IFRAN', 'documento' => '30535782', 'numero_legajo' => '1053', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' LUCAS DAVID', 'apellido' => 'IÑONES', 'documento' => '38837639', 'numero_legajo' => '1134', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => 'RODOLFO DANIEL', 'apellido' => 'IRANZO', 'documento' => '12865213', 'numero_legajo' => '111', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARCELO GUSTAVO', 'apellido' => 'IZZO', 'documento' => '27800874', 'numero_legajo' => '998', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARIO LUIS', 'apellido' => 'JACQUET', 'documento' => '13899437', 'numero_legajo' => '332', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' OSCAR ALBERTO', 'apellido' => 'JARA', 'documento' => '23111694', 'numero_legajo' => '174', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' HERNAN EDGARDO', 'apellido' => 'JUAREZ', 'documento' => '30953086', 'numero_legajo' => '578', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JAQUELINA', 'apellido' => 'KEHOE', 'documento' => '20643247', 'numero_legajo' => '1428', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' BARBARA GISELA', 'apellido' => 'KREICK', 'documento' => '31991908', 'numero_legajo' => '513', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' SERGIO EDUARDO', 'apellido' => 'KULA', 'documento' => '20860236', 'numero_legajo' => '864', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ANDRES', 'apellido' => 'LASO', 'documento' => '14386160', 'numero_legajo' => '225', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' OSCAR AGUSTIN', 'apellido' => 'LEGUIZAMON', 'documento' => '11095352', 'numero_legajo' => '559', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JAVIER CRISTIAN', 'apellido' => 'LEME', 'documento' => '31132717', 'numero_legajo' => '783', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' SOFIA', 'apellido' => 'LLANTADA', 'documento' => '31624297', 'numero_legajo' => '1116', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JUAN JOSE', 'apellido' => 'LLINARES', 'documento' => '20687221', 'numero_legajo' => '852', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' DIEGO ALEJANDRO', 'apellido' => 'LONTOYA', 'documento' => '34673368', 'numero_legajo' => '952', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARIA PAULA', 'apellido' => 'LUCCA', 'documento' => '29407450', 'numero_legajo' => '1146', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' CRISTIAN HUMBERTO', 'apellido' => 'MAISANO', 'documento' => '35233119', 'numero_legajo' => '1297', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARTIN MIGUEL', 'apellido' => 'MAMANI', 'documento' => '29299890', 'numero_legajo' => '213', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' VICTOR DANIEL', 'apellido' => 'MANSILLA', 'documento' => '17811958', 'numero_legajo' => '459', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ANDREA CRISTINA', 'apellido' => 'MARENGO', 'documento' => '20279397', 'numero_legajo' => '1183', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' DANIEL ALBERTO', 'apellido' => 'MARTINEZ QUIÑONES', 'documento' => '32325364', 'numero_legajo' => '693', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' GABRIEL PABLO', 'apellido' => 'MARTINOLI', 'documento' => '22081396', 'numero_legajo' => '259', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ELIANA SABRINA', 'apellido' => 'MASCIOTRA', 'documento' => '33116516', 'numero_legajo' => '883', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' AUGUSTO SEBASTIAN', 'apellido' => 'MATSUDA YAMADA', 'documento' => '32531268', 'numero_legajo' => '1489', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ARIEL OSVALDO', 'apellido' => 'MAURO', 'documento' => '27356219', 'numero_legajo' => '284', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' CARLOS DENIS', 'apellido' => 'MENDOZA CHAVEZ', 'documento' => '92931000', 'numero_legajo' => '812', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JORGE MARTIN', 'apellido' => 'MERELES', 'documento' => '27242431', 'numero_legajo' => '714', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' GUILLERMO FERNANDO', 'apellido' => 'MOLL', 'documento' => '36485427', 'numero_legajo' => '896', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' GONZALO JAVIER', 'apellido' => 'MONTEMURRO', 'documento' => '23124797', 'numero_legajo' => '1071', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' RICARDO MARCELO ALEJANDRO', 'apellido' => 'MORENO', 'documento' => '25863683', 'numero_legajo' => '1418', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' LUIS RODOLFO', 'apellido' => 'MOYA', 'documento' => '24136667', 'numero_legajo' => '278', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' HECTOR MARTIN', 'apellido' => 'NAVARRO', 'documento' => '26765687', 'numero_legajo' => '191', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' AGUSTIN GONZALO', 'apellido' => 'NOVO VIANA', 'documento' => '35227930', 'numero_legajo' => '1517', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' LAUREANO EZEQUIEL', 'apellido' => 'O´LERY TORRES', 'documento' => '41195304', 'numero_legajo' => '1492', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JOSE LUIS', 'apellido' => 'OJEDA', 'documento' => '29872052', 'numero_legajo' => '585', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MIGUEL ANGEL', 'apellido' => 'OLIVA', 'documento' => '14621298', 'numero_legajo' => '265', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' SERGIO OMAR', 'apellido' => 'OLIVERA', 'documento' => '31252142', 'numero_legajo' => '342', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARIEL ANDREA', 'apellido' => 'ORLANDINI', 'documento' => '28119178', 'numero_legajo' => '341', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' SERGIO DAMIAN', 'apellido' => 'OSIMANO', 'documento' => '32452314', 'numero_legajo' => '767', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' GONZALO EZEQUIEL', 'apellido' => 'OVIEDO', 'documento' => '39708316', 'numero_legajo' => '1340', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' FELIX ARMANDO', 'apellido' => 'PADILLA', 'documento' => '32259048', 'numero_legajo' => '394', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MAIRA BELEN', 'apellido' => 'PAJARO', 'documento' => '33279855', 'numero_legajo' => '505', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' CARLA VANESSA MARIA', 'apellido' => 'PALACIOS VERDE', 'documento' => '95656803', 'numero_legajo' => '1494', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' EDUARDO ANDRES AMADO', 'apellido' => 'PALMA', 'documento' => '28963845', 'numero_legajo' => '249', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' SILVIA ADRIANA', 'apellido' => 'PALMIERI', 'documento' => '16828119', 'numero_legajo' => '232', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MAGALI BELEN', 'apellido' => 'PAOLUCCIO', 'documento' => '32477837', 'numero_legajo' => '460', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' EVANGELINA', 'apellido' => 'PARRA', 'documento' => '27712993', 'numero_legajo' => '1496', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ALEJANDRO', 'apellido' => 'PAULETICH', 'documento' => '34932100', 'numero_legajo' => '1383', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' GONZALO EZEQUIEL', 'apellido' => 'PAZ MICHOPULO', 'documento' => '33910463', 'numero_legajo' => '1145', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' CECILIA', 'apellido' => 'PEREIRA CEDAN', 'documento' => '94101973', 'numero_legajo' => '1518', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JULIO EDGARDO', 'apellido' => 'PEREYRA', 'documento' => '16037634', 'numero_legajo' => '182', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' LEONEL ANDRES', 'apellido' => 'PEREYRA', 'documento' => '28831968', 'numero_legajo' => '369', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' LORENZO MARTIN', 'apellido' => 'PEREZ', 'documento' => '35230754', 'numero_legajo' => '1135', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' NICOLAS', 'apellido' => 'PICCININI', 'documento' => '32866417', 'numero_legajo' => '689', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' NATALIA GISELA', 'apellido' => 'PITTALA', 'documento' => '35335204', 'numero_legajo' => '1152', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' DAVID ALEJANDRO', 'apellido' => 'POLIDORO', 'documento' => '35065887', 'numero_legajo' => '1206', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' EZEQUIEL JESUS', 'apellido' => 'PONCE', 'documento' => '26000663', 'numero_legajo' => '941', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' FRANCISCO JAVIER', 'apellido' => 'PRANDI', 'documento' => '17522576', 'numero_legajo' => '1068', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' NATALIA PAOLA', 'apellido' => 'PUÑAL', 'documento' => '28215872', 'numero_legajo' => '1563', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JULIO MARTIN', 'apellido' => 'QUINTERO', 'documento' => '35588767', 'numero_legajo' => '652', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' EDGARDO LEONEL', 'apellido' => 'QUINTEROS', 'documento' => '35246984', 'numero_legajo' => '935', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' EMANUEL', 'apellido' => 'RACCIATTI', 'documento' => '34996605', 'numero_legajo' => '1084', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' HORACIO HERNAN', 'apellido' => 'RAMIREZ', 'documento' => '31133586', 'numero_legajo' => '343', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARTIN ALEJANDRO', 'apellido' => 'RAO', 'documento' => '28907413', 'numero_legajo' => '754', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' VICTORIA', 'apellido' => 'REALI ETCHART', 'documento' => '36171937', 'numero_legajo' => '1541', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' AGUSTIN ALBERTO', 'apellido' => 'RICO', 'documento' => '24663311', 'numero_legajo' => '1148', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' CARLOS GUSTAVO', 'apellido' => 'RIPEAU', 'documento' => '14820185', 'numero_legajo' => '140', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ANDREA KARINA', 'apellido' => 'RIVERA', 'documento' => '23431105', 'numero_legajo' => '201', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' EMILIANO', 'apellido' => 'RODERA', 'documento' => '28935256', 'numero_legajo' => '1001', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' DAVID EZEQUIEL', 'apellido' => 'RODRIGUEZ', 'documento' => '29249104', 'numero_legajo' => '374', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' FABIANA VERONICA', 'apellido' => 'RODRIGUEZ', 'documento' => '22081873', 'numero_legajo' => '916', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JUAN MARTIN', 'apellido' => 'RODRIGUEZ', 'documento' => '38294332', 'numero_legajo' => '1319', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' EMILIANO', 'apellido' => 'ROMERO', 'documento' => '33317845', 'numero_legajo' => '1437', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' GABRIEL OMAR', 'apellido' => 'ROSSI', 'documento' => '11015665', 'numero_legajo' => '253', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' GISELA MAILEN', 'apellido' => 'RUBINO', 'documento' => '34123398', 'numero_legajo' => '1157', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ROBERTO MATIAS', 'apellido' => 'RUELLA', 'documento' => '27374885', 'numero_legajo' => '1454', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MATIAS LUCIANO', 'apellido' => 'RUIZ LOPEZ', 'documento' => '27865619', 'numero_legajo' => '1219', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' BRAIAN LEONEL', 'apellido' => 'SANDES', 'documento' => '36039412', 'numero_legajo' => '932', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARCELO', 'apellido' => 'SANDOVAL', 'documento' => '32582835', 'numero_legajo' => '1359', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JUAN CARLOS', 'apellido' => 'SCHONFEL', 'documento' => '16791422', 'numero_legajo' => '542', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' NICOLAS DARIO', 'apellido' => 'SEGOVIA', 'documento' => '37349342', 'numero_legajo' => '1512', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' LUCILA', 'apellido' => 'SERRA ANDREOZZI', 'documento' => '33546420', 'numero_legajo' => '1004', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' GABRIELA ALEJANDRA', 'apellido' => 'SILVA', 'documento' => '23369800', 'numero_legajo' => '312', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' RAUL ARIEL', 'apellido' => 'SILVA', 'documento' => '33121361', 'numero_legajo' => '715', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JORGE DAMIAN', 'apellido' => 'SITTNER', 'documento' => '30066487', 'numero_legajo' => '576', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' PABLO', 'apellido' => 'SKIRMUNTT', 'documento' => '28467878', 'numero_legajo' => '996', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' CINTHIA YAEL', 'apellido' => 'SMALDONE', 'documento' => '37009016', 'numero_legajo' => '1082', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MONICA ESTHER', 'apellido' => 'SOBRADO', 'documento' => '14341015', 'numero_legajo' => '146', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' JUAN IGNACIO', 'apellido' => 'SONZINI', 'documento' => '23706962', 'numero_legajo' => '352', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' DANIEL OSCAR', 'apellido' => 'SOSA', 'documento' => '30478038', 'numero_legajo' => '819', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' EMILIANO CARLOS', 'apellido' => 'SOSA', 'documento' => '29380780', 'numero_legajo' => '381', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' SEBASTIAN IVAN', 'apellido' => 'SOSA', 'documento' => '29118475', 'numero_legajo' => '795', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' FLORENCIA', 'apellido' => 'STELE', 'documento' => '41548069', 'numero_legajo' => '1474', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' SARA CINTIA SABRINA', 'apellido' => 'SUARES', 'documento' => '34464024', 'numero_legajo' => '582', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' NICOLAS CARLOS', 'apellido' => 'TARALLO', 'documento' => '32920102', 'numero_legajo' => '1010', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MIRELLA MARGARITA', 'apellido' => 'TISSELLI', 'documento' => '24906461', 'numero_legajo' => '236', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' CLAUDIO MILCIADES', 'apellido' => 'TONANEZ', 'documento' => '28943121', 'numero_legajo' => '286', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' CRISTIAN GABRIEL', 'apellido' => 'TONDA', 'documento' => '22885850', 'numero_legajo' => '475', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ROBERTO ARMANDO', 'apellido' => 'TONIOLO', 'documento' => '14434780', 'numero_legajo' => '167', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' CESAR DARIO ALEJANDRO', 'apellido' => 'TORALES', 'documento' => '23532104', 'numero_legajo' => '338', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' GRISELDA LILIANA', 'apellido' => 'TORRES', 'documento' => '22756146', 'numero_legajo' => '162', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' LUIS ANTONIO', 'apellido' => 'TORREZ', 'documento' => '17056841', 'numero_legajo' => '209', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' AYELEN NATHALI', 'apellido' => 'TRILLO', 'documento' => '38040434', 'numero_legajo' => '1075', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' RICARDO', 'apellido' => 'TURANO', 'documento' => '25744826', 'numero_legajo' => '752', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' GONZALO', 'apellido' => 'URANGA', 'documento' => '25568115', 'numero_legajo' => '396', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' RAMON SANTIAGO', 'apellido' => 'URQUIZA', 'documento' => '21616755', 'numero_legajo' => '212', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' VICTOR HUGO', 'apellido' => 'URQUIZA', 'documento' => '17320011', 'numero_legajo' => '200', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MATIAS MARCELO', 'apellido' => 'VAGO', 'documento' => '30860295', 'numero_legajo' => '889', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' OMAR ALBERTO', 'apellido' => 'VAZQUEZ', 'documento' => '12714684', 'numero_legajo' => '177', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' WALTER ROLANDO', 'apellido' => 'VERA CABRERA', 'documento' => '33778586', 'numero_legajo' => '1095', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' EMMANUEL ANTONIO', 'apellido' => 'VERGARA', 'documento' => '38322006', 'numero_legajo' => '1083', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' HUGO IVAN', 'apellido' => 'VILA', 'documento' => '31512047', 'numero_legajo' => '454', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => 'CARLOS FABIAN', 'apellido' => 'WASZCZUK', 'documento' => '20053676', 'numero_legajo' => '207', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' MARIA CLARA', 'apellido' => 'WUNSCHE', 'documento' => '33442126', 'numero_legajo' => '1536', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' ANA MARIA', 'apellido' => 'ZACH', 'documento' => '38683572', 'numero_legajo' => '1133', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' DOMINGO JOEL', 'apellido' => 'ZOLORZANO', 'documento' => '46567251', 'numero_legajo' => '1073', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      Trabajador::create([ 'nombre' => ' CRISTIAN TOMAS', 'apellido' => 'ZUBIRIA', 'documento' => '31539654', 'numero_legajo' => '1566', 'empresa_id' => '7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), ]);
      
      


    }
}
