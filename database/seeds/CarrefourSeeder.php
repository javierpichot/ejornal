<?php

use App\Models\Empresa;
use App\Models\Trabajador;
use App\Models\PrestacionFarmaciaDroga;

use Carbon\Carbon;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class CarrefourSeeder extends Seeder
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
        'nombre' => 'Carrefour',
        'cuit' => '11234567890',
        'direccion' => 'Ruta de la Tradición 7222 - Esteban Echeverría',
        'logo' => 'carrefour.png',
        'caducidad' => '2019-11-01',
        'created_at' => '2018-05-01 16:29:37'
    ]);


      //                    tarea                     //

      $empresa->tarea()->create([
          'nombre' => 'Carga/Descarga'
      ]);

      $empresa->tarea()->create([
          'nombre' => 'Clarkista'
      ]);
      $empresa->tarea()->create([
          'nombre' => 'Conductor 1º Categoria'
      ]);

      $empresa->tarea()->create([
          'nombre' => 'Controlador logístico'
      ]);
      $empresa->tarea()->create([
          'nombre' => 'Control'
      ]);

      $empresa->tarea()->create([
          'nombre' => 'Cocina'
      ]);
      $empresa->tarea()->create([
          'nombre' => 'Mantenimiento'
      ]);

      $empresa->tarea()->create([
          'nombre' => 'Seguridad'
      ]);
      $empresa->tarea()->create([
          'nombre' => 'Limpieza'
      ]);

      $empresa->tarea()->create([
          'nombre' => 'Precintador'
      ]);
      $empresa->tarea()->create([
          'nombre' => 'Preparador'
      ]);

      $empresa->tarea()->create([
          'nombre' => 'Administrativo'
      ]);
      $empresa->tarea()->create([
          'nombre' => 'Jalador'
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
          'nombre' => 'Actividad 4'
      ]);
      $empresa->sector()->create([
          'nombre' => 'Autoelevador'
      ]);
      $empresa->sector()->create([
          'nombre' => 'Ballet'
      ]);
      $empresa->sector()->create([
          'nombre' => 'Batería'
      ]);
      $empresa->sector()->create([
          'nombre' => 'Cross Docking'
      ]);
      $empresa->sector()->create([
          'nombre' => 'Eventual'
      ]);
      $empresa->sector()->create([
          'nombre' => 'Expedición'
      ]);
      $empresa->sector()->create([
          'nombre' => 'Externo'
      ]);
      $empresa->sector()->create([
          'nombre' => 'Gestión de stock'
      ]);
      $empresa->sector()->create([
          'nombre' => 'Gremial'
      ]);
      $empresa->sector()->create([
          'nombre' => 'Logística'
      ]);
      $empresa->sector()->create([
          'nombre' => 'Mantenimiento'
      ]);
      $empresa->sector()->create([
          'nombre' => 'Merma'
      ]);
      $empresa->sector()->create([
          'nombre' => 'Preparación'
      ]);
      $empresa->sector()->create([
          'nombre' => 'Recepción'
      ]);
      $empresa->sector()->create([
          'nombre' => 'Symbol'
      ]);
      $empresa->sector()->create([
          'nombre' => 'Validación'
      ]);
      
      
      Trabajador::create([       'nombre' => 'Gustavo',       'apellido' => 'Núñez',       'documento' => '14515453',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Lucas',       'apellido' => 'Chavez',       'documento' => '45464564',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Fabian Alberto',       'apellido' => 'Fleitas',       'documento' => '33368127',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Mauricio Nicolas',       'apellido' => 'Espindola',       'documento' => '29480095',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Alberto Fabian',       'apellido' => 'Rivas',       'documento' => '30023053',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Carlos Gabriel',       'apellido' => 'Contreras',       'documento' => '38626597',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Dario Rafael',       'apellido' => 'Frette',       'documento' => '29689977',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Leandro Hernan',       'apellido' => 'Andrade',       'documento' => '39744163',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Roberto Luis',       'apellido' => 'Dols',       'documento' => '28364412',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Brian',       'apellido' => 'Leguizamón',       'documento' => '38073102',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Miguel',       'apellido' => 'Bulacio',       'documento' => '22502810',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Emanuel',       'apellido' => 'Barrios',       'documento' => '35802676',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Mauricio',       'apellido' => 'Taborda',       'documento' => '41797255',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Carlos Sebastian',       'apellido' => 'Freire',       'documento' => '27822271',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Raul Roberto',       'apellido' => 'Gonzalez',       'documento' => '34622002',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jonathan Oscar',       'apellido' => 'Villalba',       'documento' => '38620410',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Hernán Ezequiel',       'apellido' => 'Mele',       'documento' => '32986173',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jorge Ruben',       'apellido' => 'Rodas',       'documento' => '94289404',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Analía',       'apellido' => 'Vargas',       'documento' => '30625601',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Cesar Daniel',       'apellido' => 'Lamas',       'documento' => '28278496',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Rolando',       'apellido' => 'Rotela',       'documento' => '31329864',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Josué Ezequiel',       'apellido' => 'Coria',       'documento' => '38971988',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ezequiel Gaston',       'apellido' => 'Garesio',       'documento' => '39418164',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Daniel Eneas Eliel',       'apellido' => 'Arena',       'documento' => '34711167',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Sergio',       'apellido' => 'Barrios',       'documento' => '26719050',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Carlos',       'apellido' => 'Navarro',       'documento' => '38049859',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Esteban',       'apellido' => 'Lagoria',       'documento' => '32190283',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Olga Ester',       'apellido' => 'Bournissen',       'documento' => '28060882',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Marcos',       'apellido' => 'Lopez',       'documento' => '20800863',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Sebastian Juan',       'apellido' => 'Lara',       'documento' => '28168187',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Leonardo Matias',       'apellido' => 'Romero',       'documento' => '33467877',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Rorigo',       'apellido' => 'Cejas barro',       'documento' => '32655486',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Daniel Alejandro',       'apellido' => 'Vega',       'documento' => '30956475',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jonathan Andres',       'apellido' => 'Gomez',       'documento' => '36176154',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Cristian Roberto',       'apellido' => 'Araujo',       'documento' => '31177624',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Juan Manuel',       'apellido' => 'Rodiño',       'documento' => '30425069',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Juan Carlos',       'apellido' => 'Sarate',       'documento' => '30668772',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Calipto Eugenio',       'apellido' => 'Martinez',       'documento' => '36938896',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ariel',       'apellido' => 'Giménez',       'documento' => '38029849',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Hector Gustavo',       'apellido' => 'Acevedo',       'documento' => '31746395',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Adriano Gabriel',       'apellido' => 'Diaz',       'documento' => '39113219',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Hernán Alberto',       'apellido' => 'Ramírez',       'documento' => '35322357',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Tereza Beatriz',       'apellido' => 'Rojas',       'documento' => '26010327',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Oscar Andres',       'apellido' => 'Villagra',       'documento' => '24195006',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ariel Alejandro',       'apellido' => 'Espino',       'documento' => '27479767',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Alejandro Emanuel',       'apellido' => 'Pereyra',       'documento' => '38095343',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Pablo Daniel',       'apellido' => 'Kozlowski',       'documento' => '34513325',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Mario Leandro',       'apellido' => 'Terceros',       'documento' => '39268935',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Carlos Daniel',       'apellido' => 'Gonzalez',       'documento' => '28709236',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Andrea',       'apellido' => 'Emens',       'documento' => '27584600',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Pablo Martin',       'apellido' => 'Resquin',       'documento' => '34521500',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Maximiliano',       'apellido' => 'Noguera',       'documento' => '34276256',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Rodrigo Lorenzo',       'apellido' => 'Tula',       'documento' => '38266220',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Federico',       'apellido' => 'Montiel',       'documento' => '34419479',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Leonardo Lujan',       'apellido' => 'Rosa',       'documento' => '31175227',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Claudio',       'apellido' => 'Garcia',       'documento' => '17974607',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Salomon Leonel',       'apellido' => 'Bulla',       'documento' => '34875243',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jorge Emmanuel',       'apellido' => 'Malinawsky',       'documento' => '31655748',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ariel Ricardo',       'apellido' => 'Vera',       'documento' => '39409114',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Natalia',       'apellido' => 'Zalazar',       'documento' => '30356396',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Luis',       'apellido' => 'Maggiolino',       'documento' => '28112646',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Maximiliano',       'apellido' => 'Ayala',       'documento' => '36883306',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Dutra',       'apellido' => 'Lucas daniel',       'documento' => '40240806',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Franco Nicolas',       'apellido' => 'Cardozo',       'documento' => '42030607',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Roberto Gabriel',       'apellido' => 'Espinola',       'documento' => '39270730',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'David Mauricio',       'apellido' => 'Coronel',       'documento' => '27737369',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Nestor Gabriel',       'apellido' => 'Cano',       'documento' => '25061625',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Gerardo Esteban',       'apellido' => 'Iriarte',       'documento' => '20323513',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'David Eduardo',       'apellido' => 'Herrera',       'documento' => '42238441',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Matias',       'apellido' => 'Galvan',       'documento' => '40136617',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Omar Agustín',       'apellido' => 'Nuñez',       'documento' => '23701961',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Leandro Joaquín',       'apellido' => 'Oliva ortíz',       'documento' => '30826690',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Hector David',       'apellido' => 'Ibañez',       'documento' => '29877128',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Matias',       'apellido' => 'Franco',       'documento' => '34157653',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Miguel',       'apellido' => 'Azas',       'documento' => '30308113',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Oscar Alberto',       'apellido' => 'Elorreaga',       'documento' => '24758718',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Tomas Nahuel',       'apellido' => 'Ferreyra',       'documento' => '39963104',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Walter Orlando',       'apellido' => 'Padilla',       'documento' => '31292893',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jonatan',       'apellido' => 'Ávila',       'documento' => '34384807',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Carlos Atilio',       'apellido' => 'Encina',       'documento' => '31414732',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Armando Ivan',       'apellido' => 'Vagett',       'documento' => '39433991',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'René',       'apellido' => 'Alfonzo',       'documento' => '11290043',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Marcelo',       'apellido' => 'Nuñez',       'documento' => '27103946',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Juan Antonio',       'apellido' => 'Medina',       'documento' => '29492377',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Gonzalo Ezequiel',       'apellido' => 'Bustamante',       'documento' => '34576485',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Miguel',       'apellido' => 'Dominguez',       'documento' => '23722902',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Pablo',       'apellido' => 'Guerrero',       'documento' => '37835866',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Luciano Ezequiel',       'apellido' => 'Vera',       'documento' => '38253320',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Cristian',       'apellido' => 'Albornoz',       'documento' => '35974531',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Andrés',       'apellido' => 'Luna',       'documento' => '31067748',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Paulo José',       'apellido' => 'Dacal',       'documento' => '22630045',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Leandro Jeremías',       'apellido' => 'Arcangioli',       'documento' => '36688306',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ezequiel Gonzalo Nahuel',       'apellido' => 'Flores',       'documento' => '29122398',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Pablo Ezequiel',       'apellido' => 'Viaña',       'documento' => '33673787',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Angel Luis',       'apellido' => 'Tuhay',       'documento' => '37099098',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Fabián',       'apellido' => 'Bertolini',       'documento' => '21478812',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Fabián Marcelo',       'apellido' => 'Medrano',       'documento' => '26471968',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Lucas Matias',       'apellido' => 'Fouce',       'documento' => '351369244',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Federico Gonzalo',       'apellido' => 'Vallejo',       'documento' => '38511697',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Esteban',       'apellido' => 'Sarrias',       'documento' => '29561037',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Alejandro Ranulfo',       'apellido' => 'Cueva',       'documento' => '22801934',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ruben Gabriel',       'apellido' => 'Villalba',       'documento' => '34232285',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Víctor Ariel',       'apellido' => 'González',       'documento' => '30052014',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Cristian Leonel',       'apellido' => 'Acosta',       'documento' => '23472257',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Tomás Rafael',       'apellido' => 'Martínez',       'documento' => '35790067',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Javier Ignacio',       'apellido' => 'Darchez',       'documento' => '25899376',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Federico Ariel',       'apellido' => 'Montaño',       'documento' => '29516505',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Julian',       'apellido' => 'Saragoza',       'documento' => '40379657',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Leonardo Ruperto',       'apellido' => 'Arrambery alfonso',       'documento' => '35613348',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Federico Silvano',       'apellido' => 'Ramírez',       'documento' => '38390562',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Esteban Hernán',       'apellido' => 'Colman',       'documento' => '36954965',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Mancos Andrés',       'apellido' => 'Robledo',       'documento' => '29131390',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Patricia Noemí',       'apellido' => 'Viollaz',       'documento' => '23853211',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ezequiel Damián',       'apellido' => 'Retamoso',       'documento' => '38666974',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Claudio Daniel',       'apellido' => 'Sosa',       'documento' => '28210425',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Gabriel Alejandro',       'apellido' => 'Torga',       'documento' => '25947910',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Francisco David',       'apellido' => 'Cabaña sugastti',       'documento' => '94653864',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Rubén Matías',       'apellido' => 'Penoni',       'documento' => '35215510',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Claudio Alejandro',       'apellido' => 'González',       'documento' => '33389130',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Martín Ezequiel',       'apellido' => 'Banegas',       'documento' => '37869312',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Santiago Pablo',       'apellido' => 'Ruiz díaz',       'documento' => '39407118',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Carlos Alberto',       'apellido' => 'Cardozo',       'documento' => '27769895',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Carlos Sebastián',       'apellido' => 'Barraza',       'documento' => '32120581',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Alan Jesús',       'apellido' => 'Saravi',       'documento' => '39470532',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Cristian Daniel',       'apellido' => 'Leiva',       'documento' => '37895323',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Eduardo Raúl',       'apellido' => 'Fusaro',       'documento' => '24185578',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Martín Dario',       'apellido' => 'Fernandez',       'documento' => '22639893',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Daniel Oscar',       'apellido' => 'Augusto',       'documento' => '34394571',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Roney Marcelo',       'apellido' => 'Acosta diaz',       'documento' => '94849638',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Gastòn',       'apellido' => 'Moyano',       'documento' => '30183237',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Lucas Ezequiel',       'apellido' => 'Galota',       'documento' => '40946445',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Daniel',       'apellido' => 'Miño',       'documento' => '14125455',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Gustavo Carlos',       'apellido' => 'Mansilla',       'documento' => '31098831',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jonathan Leonel',       'apellido' => 'Alvarado',       'documento' => '38701740',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Roberto Andrés',       'apellido' => 'Aguirre',       'documento' => '37340381',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Walter Javier',       'apellido' => 'Molina',       'documento' => '34319103',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jorge Leonel',       'apellido' => 'Vallejos',       'documento' => '39406007',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Carlos Hernán',       'apellido' => 'Almada',       'documento' => '29365122',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Mariano',       'apellido' => 'Mur',       'documento' => '18093574',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Gustavo Martin',       'apellido' => 'Cardozo',       'documento' => '31391714',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Diego Emmanuel',       'apellido' => 'Barboza',       'documento' => '35137668',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Lucas Javier',       'apellido' => 'Vera',       'documento' => '41231934',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Lautaro Nicolás',       'apellido' => 'García',       'documento' => '44394511',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ariel Rubén',       'apellido' => 'Massuani',       'documento' => '23050943',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Oscar Gabriel',       'apellido' => 'Gomez',       'documento' => '28458929',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ulises',       'apellido' => 'Saravia',       'documento' => '28459725',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Damian Ruben',       'apellido' => 'Zayas',       'documento' => '33459049',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Sergio Daniel',       'apellido' => 'Zalazar',       'documento' => '27152118',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Juan Emanuel',       'apellido' => 'Zabala',       'documento' => '35118599',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Celso Francisco',       'apellido' => 'Yulan',       'documento' => '23375691',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Luciano Emanuel',       'apellido' => 'Yebenes',       'documento' => '37256863',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Hugo Orlando',       'apellido' => 'Ybañez',       'documento' => '25555021',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Damian Gerardo',       'apellido' => 'Yanneli',       'documento' => '30366478',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Walter Emmanuel',       'apellido' => 'Yamanga',       'documento' => '32944012',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Diego Omar',       'apellido' => 'Wolenberg',       'documento' => '29941806',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Rolando',       'apellido' => 'Vilte',       'documento' => '22701746',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Roque Dario',       'apellido' => 'Villarreal',       'documento' => '21622931',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Norberto Alejandro',       'apellido' => 'Villareal',       'documento' => '28799469',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jonatan David',       'apellido' => 'Villalba',       'documento' => '34760311',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Rubén Jesús',       'apellido' => 'Vilchez ayras',       'documento' => '93866289',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Eduardo Maximiliano',       'apellido' => 'Vidal',       'documento' => '28820776',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Santiago',       'apellido' => 'Vescovich',       'documento' => '33119580',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Juan Eduardo',       'apellido' => 'Vergara',       'documento' => '26749061',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Hernan Patricio',       'apellido' => 'Vergara sandoval',       'documento' => '93052254',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Hector Omar',       'apellido' => ' Verde',       'documento' => '16962941',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Juan Ramon',       'apellido' => 'Vera',       'documento' => '22530610',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Jorge Rafael',       'apellido' => ' Vera',       'documento' => '26516941',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Emanuel Aldo',       'apellido' => ' Vera',       'documento' => '28353615',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Marcelo Ruben',       'apellido' => 'Venegas',       'documento' => '25220023',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Hector Luis',       'apellido' => 'Vega',       'documento' => '30003839',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Luis Antonio',       'apellido' => 'Vargas',       'documento' => '23246889',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Diego Sebastian',       'apellido' => ' Vargas',       'documento' => '28712446',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Leonardo Alejandro',       'apellido' => ' Vallone',       'documento' => '29304794',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Daniel Alejandro',       'apellido' => 'Valentini',       'documento' => '31435353',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Carlos Dante',       'apellido' => ' Valdez',       'documento' => '26576437',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Pablo Damian',       'apellido' => ' Uñates',       'documento' => '32526404',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jonatan Esteban',       'apellido' => 'Uñates',       'documento' => '33928184',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Victor Hugo',       'apellido' => ' Tuillier',       'documento' => '25545232',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Cristobal Sergio',       'apellido' => 'Trinidad',       'documento' => '25772629',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Christian Ariel',       'apellido' => 'Trabichet',       'documento' => '30162096',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Daniel Omar',       'apellido' => ' Tosi',       'documento' => '16915181',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Pablo Daniel',       'apellido' => ' Torres',       'documento' => '26176309',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Juan Emilio',       'apellido' => 'Torres',       'documento' => '28066930',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Guillermo Ariel',       'apellido' => 'Torres',       'documento' => '29947199',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Gerardo Adrian',       'apellido' => 'Torres',       'documento' => '29492993',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Facundo Cruz',       'apellido' => ' Torres',       'documento' => '34704402',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Diego Ruben',       'apellido' => ' Torres',       'documento' => '27151557',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Cristian Javier',       'apellido' => ' Torres',       'documento' => '28685775',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Claudio Fabricio',       'apellido' => 'Torres celedon',       'documento' => '23977637',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ernesto Ramon',       'apellido' => 'Toledo',       'documento' => '20896319',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Walter Ruben',       'apellido' => ' Tiseira',       'documento' => '23753719',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Eduardo',       'apellido' => ' Ticlla chacchi',       'documento' => '93871749',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Dionisio',       'apellido' => ' Talavera',       'documento' => '13645049',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Raul David',       'apellido' => ' Taipe lopez',       'documento' => '94034480',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Raul Eduardo',       'apellido' => ' Suarez',       'documento' => '20983913',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Orlando Osmar',       'apellido' => ' Suarez',       'documento' => '26022023',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jose Luis',       'apellido' => 'Spath',       'documento' => '25430060',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Alejandro Francisco',       'apellido' => 'Soto',       'documento' => '21455467',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ramon Arnaldo',       'apellido' => 'Sosa',       'documento' => '28963800',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Lino Cesar',       'apellido' => ' Soloaga',       'documento' => '25645782',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Mariano Agustin',       'apellido' => ' Silva',       'documento' => '29199944',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Diego Javier',       'apellido' => ' Silva',       'documento' => '27153168',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ariel Hernan',       'apellido' => 'Siles',       'documento' => '36398666',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Oscar Anibal',       'apellido' => 'Segovia',       'documento' => '23073659',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Nestor David',       'apellido' => ' Segovia',       'documento' => '27071885',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Carlos Alberto',       'apellido' => ' Scarvaglieri',       'documento' => '24226271',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Dionisio Reyes',       'apellido' => 'Santos alexander',       'documento' => '93905123',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Mauro Alejandro',       'apellido' => ' Santillan',       'documento' => '27710832',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Juan Marcelo ',       'apellido' => ' Santillan',       'documento' => '27853638',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Jose Luis',       'apellido' => ' Santander',       'documento' => '27272692',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Hector',       'apellido' => 'Sandoval',       'documento' => '31443723',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Gustavo David',       'apellido' => 'Sandobal',       'documento' => '26315597',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jorge Cristian',       'apellido' => 'Sanchez',       'documento' => '25496073',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Gustavo Ramon',       'apellido' => 'Sanchez',       'documento' => '26731333',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Alan Isaias',       'apellido' => ' Salinas',       'documento' => '27858042',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Diego Ariel',       'apellido' => ' Ruiz',       'documento' => '28166258',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Claudio Alberto',       'apellido' => ' Ruiz',       'documento' => '28300144',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Leonardo',       'apellido' => ' Ruiz diaz',       'documento' => '33204898',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Diego Orlando',       'apellido' => 'Ruiz diaz',       'documento' => '29823039',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Carlos Alberto',       'apellido' => 'Rossoli',       'documento' => '30354156',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Aldo Gustavo',       'apellido' => ' Rosi',       'documento' => '25232231',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Sergio Ramón',       'apellido' => ' Romero',       'documento' => '28332509',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Osvaldo Norberto',       'apellido' => ' Romero',       'documento' => '27339428',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jonathan David',       'apellido' => 'Romero',       'documento' => '35100380',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Gustavo Fernando',       'apellido' => ' Romero',       'documento' => '27339111',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Fabian',       'apellido' => 'Romero',       'documento' => '27089090',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Edgar Emiliano',       'apellido' => ' Romero',       'documento' => '35753170',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Carlos Jorge',       'apellido' => ' Romero',       'documento' => '28258271',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Leandro Gaston',       'apellido' => 'Romano',       'documento' => '28228870',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Claudio Oscar',       'apellido' => ' Roman',       'documento' => '27024791',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ramon Ernesto',       'apellido' => 'Rolon',       'documento' => '23876316',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Sergio Eduardo',       'apellido' => ' Roldan',       'documento' => '24022331',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Diego Rodrigo',       'apellido' => ' Roldan',       'documento' => '27357643',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Ruben Adrian',       'apellido' => ' Rojas',       'documento' => '26886554',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Dario Rene',       'apellido' => ' Rojas',       'documento' => '23812147',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Carlos Ariel',       'apellido' => 'Rojas',       'documento' => '27906142',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Walter Alejandro',       'apellido' => ' Rojas zelaya',       'documento' => '20199934',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Ramon Armando',       'apellido' => ' Rodriguez',       'documento' => '26468062',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Luis Angel',       'apellido' => 'Rodriguez',       'documento' => '22982878',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Juan Pablo',       'apellido' => ' Rodriguez',       'documento' => '32983221',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Hector Gabriel',       'apellido' => ' Rodriguez',       'documento' => '21461924',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Elias Ezequiel',       'apellido' => 'Rodriguez',       'documento' => '34967774',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Carlos Ariel',       'apellido' => 'Rodriguez',       'documento' => '26198614',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Adrian Abel',       'apellido' => 'Rodas',       'documento' => '34210303',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Luis Alberto',       'apellido' => ' Rocha',       'documento' => '29304790',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Christian Ramon',       'apellido' => ' Robledo',       'documento' => '27049986',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Andrea Fabiana',       'apellido' => ' Robledo',       'documento' => '24476604',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Miguel Angel',       'apellido' => 'Rivero',       'documento' => '24342147',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Juan Carlos',       'apellido' => 'Rivero',       'documento' => '27371829',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Christian Alberto',       'apellido' => ' Rivero',       'documento' => '22582346',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Walter Ismael',       'apellido' => ' Rivas',       'documento' => '30731911',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Hugo Orlando',       'apellido' => 'Rivarola',       'documento' => '25645543',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Gabriel Edgardo',       'apellido' => 'Riva',       'documento' => '29432888',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jorge Omar',       'apellido' => 'Rippa',       'documento' => '13059560',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Esteban Pedro',       'apellido' => ' Ripoli',       'documento' => '27788765',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Marcelo Carlos',       'apellido' => 'Rios',       'documento' => '23554090',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Pedro Ariel',       'apellido' => ' Reynoso',       'documento' => '27316211',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Juan Ramon',       'apellido' => ' Reyes',       'documento' => '26643923',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Antonio Cruz',       'apellido' => ' Reyes',       'documento' => '14234843',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Alberto Pascual',       'apellido' => ' Reyes',       'documento' => '27696159',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Juan Ramon',       'apellido' => ' Ramirez',       'documento' => '24514937',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Gustavo Ezequiel',       'apellido' => ' Ramirez',       'documento' => '28283183',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Alexis Gaston',       'apellido' => 'Ramirez',       'documento' => '27309338',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Jonatan Anibal',       'apellido' => ' Raffaulte',       'documento' => '33434506',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Ruben Dario',       'apellido' => ' Quiroga',       'documento' => '24335024',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Sebastian Omar',       'apellido' => ' Quinteros',       'documento' => '33555755',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Cristian Emanuel',       'apellido' => 'Prado',       'documento' => '28618415',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Matias Damian',       'apellido' => ' Pitarelli',       'documento' => '28282761',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Damian',       'apellido' => 'Pirruccio',       'documento' => '27343334',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Pablo Daniel',       'apellido' => 'Picardi',       'documento' => '34056685',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Marcelo Fabian',       'apellido' => 'Persico',       'documento' => '21463618',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Juan Jose',       'apellido' => 'Perez',       'documento' => '31504475',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Daniel German',       'apellido' => 'Perez',       'documento' => '21822793',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Carlos Sebastian',       'apellido' => ' Perez',       'documento' => '32421107',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Luis Alberto',       'apellido' => ' Pereyra',       'documento' => '30383407',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Ariel Leandro',       'apellido' => ' Pereira',       'documento' => '31597948',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Saulo Matias',       'apellido' => ' Perdiguero',       'documento' => '34579979',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Gustavo Marcelo',       'apellido' => ' Peralta',       'documento' => '23284173',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Aldo Ramon',       'apellido' => 'Peralta',       'documento' => '21050675',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Antonio Ramon',       'apellido' => ' Penteado',       'documento' => '14238585',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Javier Raul',       'apellido' => ' Peñalba',       'documento' => '25836674',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Marcelo Jose',       'apellido' => ' Pellegrino',       'documento' => '23114491',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Rodolfo Julio',       'apellido' => ' Pellegrini',       'documento' => '20347387',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Pablo Ariel',       'apellido' => 'Peger',       'documento' => '26841980',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Hector Edgardo',       'apellido' => 'Pedraza',       'documento' => '23367246',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Santos Urbano',       'apellido' => ' Paz',       'documento' => '14520749',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Daniel Anibal',       'apellido' => ' Paz',       'documento' => '18374816',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Gustavo Javier',       'apellido' => 'Parera',       'documento' => '29075545',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Rene Gabriel',       'apellido' => 'Pared',       'documento' => '29517787',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Ricardo Miguel',       'apellido' => ' Parada',       'documento' => '23825478',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Martin Gaston',       'apellido' => 'Palavecino',       'documento' => '30590939',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ariel Norberto',       'apellido' => 'Pajon',       'documento' => '25189225',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Juvenal Alberto',       'apellido' => ' Paez',       'documento' => '29503918',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Bernardo David',       'apellido' => ' Ozorio',       'documento' => '21086745',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Raul Oscar',       'apellido' => ' Orue',       'documento' => '30603363',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Leandro Diego',       'apellido' => 'Ortiz',       'documento' => '28233039',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Jose Luis',       'apellido' => ' Ortiz',       'documento' => '27202317',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Ismael',       'apellido' => ' Ortiz',       'documento' => '29882760',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Ignacio David',       'apellido' => ' Ortiz',       'documento' => '33035421',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Elio Jorge',       'apellido' => 'Orquera',       'documento' => '29705848',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Gustavo Ariel',       'apellido' => ' Ordoñez',       'documento' => '27924422',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Nestor Samuel',       'apellido' => 'Ojeda',       'documento' => '24824797',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Marcelo Ariel',       'apellido' => 'Ojeda',       'documento' => '23605237',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Marcelo Alejandro',       'apellido' => ' Ojeda sotelo',       'documento' => '31596786',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Marcelo David',       'apellido' => ' Ocampo',       'documento' => '29627851',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Walter Antonio',       'apellido' => ' Obregon',       'documento' => '3632559',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Sergio Ariel',       'apellido' => 'Nuñez',       'documento' => '29521345',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Martin Ariel',       'apellido' => ' Nuñez',       'documento' => '32422338',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Julio Cesar',       'apellido' => 'Nuñez',       'documento' => '20006744',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Anibal Roberto',       'apellido' => 'Nuñez',       'documento' => '29910346',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Jose Agustin',       'apellido' => ' Noto marta',       'documento' => '29982650',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Walter Daniel',       'apellido' => ' Negro',       'documento' => '30052864',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Ramiro',       'apellido' => ' Muñoz pelaez',       'documento' => '93001720',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Julio Cesar',       'apellido' => 'Moreyra',       'documento' => '30210242',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' David Aaron',       'apellido' => ' Moreno',       'documento' => '32821946',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Carlos Raul',       'apellido' => ' Moreno',       'documento' => '33302517',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Alberto Antonio',       'apellido' => 'Moreno',       'documento' => '27740389',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Javier Sebastian',       'apellido' => 'Morel',       'documento' => '27779961',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Angel Gabriel',       'apellido' => ' Moreira',       'documento' => '28951222',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Emanuel Alberto',       'apellido' => 'More ferrando',       'documento' => '32016410',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ovidio Ramon',       'apellido' => 'Montivero',       'documento' => '30667131',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Daniel Gustavo',       'apellido' => 'Montenegro',       'documento' => '24645789',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jonathan Renato',       'apellido' => 'Montenegro muñoz',       'documento' => '94017202',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Sergio Daniel',       'apellido' => 'Monson',       'documento' => '30086394',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Rodrigo Emmanuel',       'apellido' => ' Molina',       'documento' => '30438604',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Victor Miguel',       'apellido' => ' Mistretta',       'documento' => '26824911',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Dario Armando',       'apellido' => 'Michia',       'documento' => '28363120',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Nestor Jorge',       'apellido' => ' Meza',       'documento' => '26201849',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Eduardo Ovidio',       'apellido' => ' Meza',       'documento' => '26320181',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jorge Daniel',       'apellido' => 'Meza coronel',       'documento' => '93894082',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Javier',       'apellido' => ' Mesler',       'documento' => '27339781',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Marco Antonio',       'apellido' => 'Mendoza',       'documento' => '23955103',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Jose Luis',       'apellido' => ' Mendoza',       'documento' => '23958346',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Horacio Sebastian',       'apellido' => ' Mendez',       'documento' => '29393733',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Marcelo Hugo',       'apellido' => 'Medina',       'documento' => '17917692',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Leonardo Sebastian',       'apellido' => ' Medina',       'documento' => '28409723',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ezequiel Hernán',       'apellido' => 'Maya',       'documento' => '33915368',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Dario Ricardo',       'apellido' => ' Matto',       'documento' => '30896160',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Sergio Leonardo',       'apellido' => ' Martinez',       'documento' => '28458901',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Osvaldo Americo',       'apellido' => ' Martinez',       'documento' => '26822538',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Norberto',       'apellido' => ' Martinez',       'documento' => '27338461',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' David Nestor',       'apellido' => ' Martinez',       'documento' => '35617478',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Claudio Roberto',       'apellido' => 'Martinez',       'documento' => '28858239',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Carlos Ezequiel',       'apellido' => ' Martinez',       'documento' => '34535977',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Rodolfo Adrian',       'apellido' => ' Mansilla',       'documento' => '24405428',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Miguel Eduardo',       'apellido' => 'Mansilla',       'documento' => '17768437',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Francisco Alberto',       'apellido' => 'Mansilla',       'documento' => '22246914',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Miguel Angel',       'apellido' => 'Manchula',       'documento' => '17702304',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Sergio Daniel',       'apellido' => ' Maldonado',       'documento' => '27455677',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Raul Javier',       'apellido' => ' Maldonado',       'documento' => '26495055',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Lucas Maximiliano',       'apellido' => 'Makarczuk',       'documento' => '29692617',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Isidro Javier',       'apellido' => ' Mainero',       'documento' => '24166709',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Rodolfo Fernando',       'apellido' => 'Maidana',       'documento' => '26857615',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Pablo Sebastian',       'apellido' => 'Maidana',       'documento' => '31163857',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Gerardo Ariel',       'apellido' => ' Maidana',       'documento' => '21051056',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Diego Gaston',       'apellido' => 'Maidana',       'documento' => '26061257',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Jorge Ramon',       'apellido' => ' Maciel',       'documento' => '27923961',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Lucas Mariano',       'apellido' => ' Macedo',       'documento' => '30020227',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Sergio Gonzalo',       'apellido' => ' Luna',       'documento' => '30414764',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Luis Demetrio',       'apellido' => ' Luna',       'documento' => '27190724',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Juan Pablo',       'apellido' => ' Luna',       'documento' => '34384465',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Diego Omar',       'apellido' => ' Luna',       'documento' => '29899033',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Victor Hugo',       'apellido' => ' Lopez',       'documento' => '31154097',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Matias Federico',       'apellido' => ' Lopez',       'documento' => '25966639',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Juan Ignacio',       'apellido' => ' Lopez',       'documento' => '11232695',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Alejandro Augusto',       'apellido' => ' Lopez',       'documento' => '28434351',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Hector Rolando',       'apellido' => ' Lobos',       'documento' => '14950234',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Nestor Fabian',       'apellido' => 'Lobo',       'documento' => '29815382',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Pablo Javier',       'apellido' => 'Lezcano',       'documento' => '28030266',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Ezequiel Rafael',       'apellido' => ' Lezcano',       'documento' => '31191200',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Victor Anibal',       'apellido' => 'Lezana',       'documento' => '18326047',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ramon Ruben',       'apellido' => 'Leiva',       'documento' => '16315363',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Osvaldo Javier',       'apellido' => ' Leiva',       'documento' => '27289916',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Felix Osvaldo',       'apellido' => ' Leguizamon',       'documento' => '13865918',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Walter Horacio',       'apellido' => ' Ledesma',       'documento' => '22702461',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Walter Damian',       'apellido' => 'Ledesma',       'documento' => '48299195',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Luciano Nicolas',       'apellido' => 'Ledesma',       'documento' => '32989973',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Hugo Walter',       'apellido' => 'Ledesma',       'documento' => '28569547',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Carlos Alberto',       'apellido' => ' Lazarte',       'documento' => '20411527',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Jose Antonio',       'apellido' => ' Laurito',       'documento' => '28163533',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jose Miguel',       'apellido' => 'Landriel',       'documento' => '23215549',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Silvio Orlando',       'apellido' => ' Kuchar',       'documento' => '26953510',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Fernando Daniel',       'apellido' => ' Kildoff',       'documento' => '25400769',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Jorge Alejandro',       'apellido' => ' Jose',       'documento' => '22605457',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Juan Esteban',       'apellido' => ' Irigoyen',       'documento' => '25070474',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Roberto Carlos',       'apellido' => 'Insaurralde',       'documento' => '27269134',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Daniel Eduardo',       'apellido' => ' Insaurralde',       'documento' => '33985924',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Juan Bautista',       'apellido' => ' Ibarra',       'documento' => '30305198',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Ruben David',       'apellido' => ' Hidalgo',       'documento' => '33148187',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Pablo Julian',       'apellido' => ' Hidalgo',       'documento' => '25001969',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Walter Hernan',       'apellido' => 'Herrera',       'documento' => '31208319',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Sergio Leandro',       'apellido' => 'Herrera',       'documento' => '31203923',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Lujan Miguel Angel',       'apellido' => ' Hernandez',       'documento' => '17488879',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Nery Adrian',       'apellido' => 'Hermosilla',       'documento' => '25710823',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Walter Gustavo',       'apellido' => ' Heredia',       'documento' => '23085164',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Victor Ramon',       'apellido' => 'Heredia',       'documento' => '22516019',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Daniel Francisco',       'apellido' => ' Heinrich',       'documento' => '17978674',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Emilio Daniel',       'apellido' => 'Gutierrez',       'documento' => '27085900',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Omar',       'apellido' => 'Gutierrez huallpa santos',       'documento' => '92510952',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Gabriel Ernesto',       'apellido' => ' Granada',       'documento' => '30064304',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Matias Ezequiel',       'apellido' => 'Gramajo',       'documento' => '31014217',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Cristian David',       'apellido' => ' Gorocito',       'documento' => '24921523',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Santiago Fabian',       'apellido' => ' Gonzalez',       'documento' => '33255187',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Roberto Carlos',       'apellido' => 'Gonzalez',       'documento' => '21139511',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Martin Daniel',       'apellido' => ' Gonzalez',       'documento' => '25855008',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Mariano Sebastan',       'apellido' => ' Gonzalez',       'documento' => '28488502',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Julio Cesar',       'apellido' => ' Gonzalez',       'documento' => '22791177',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Juan Carlos',       'apellido' => 'Gonzalez',       'documento' => '17702452',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Hector Oscar',       'apellido' => 'Gonzalez',       'documento' => '27152734',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Hector Orlando',       'apellido' => 'Gonzalez',       'documento' => '18298772',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Gustavo Rodrigo',       'apellido' => ' Gonzalez',       'documento' => '29118160',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Damian Gaston Gabino',       'apellido' => 'Gonzalez',       'documento' => '27495048',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Carlos Alberto',       'apellido' => 'Gonzalez',       'documento' => '29865099',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Alejandro Leonardo',       'apellido' => ' Gonzalez',       'documento' => '26315779',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ramon Eleuterio',       'apellido' => 'Gomez',       'documento' => '17570916',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Elias Ignacio',       'apellido' => ' Gomez',       'documento' => '28897349',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Dario Ruben',       'apellido' => 'Gomez',       'documento' => '21639449',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Agustin',       'apellido' => 'Gomez',       'documento' => '14694478',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jorge Ruben',       'apellido' => 'Gomez de la fuente',       'documento' => '24226594',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Maximiliano Ezequiel',       'apellido' => 'Godoy',       'documento' => '34181820',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ruben Adrian',       'apellido' => 'Gimenez',       'documento' => '28379549',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Mario Gabriel',       'apellido' => ' Gerez',       'documento' => '21475474',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Victor Hugo',       'apellido' => ' Gerez quiroga',       'documento' => '34761355',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Juan Pablo',       'apellido' => 'Gauto cardozo',       'documento' => '28504285',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Fabian',       'apellido' => ' Garrido',       'documento' => '92833773',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Santiago Jeronimo',       'apellido' => ' Garcia',       'documento' => '26523549',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Omar Horacio',       'apellido' => 'Garcia',       'documento' => '17788568',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Alejandro Reynol',       'apellido' => ' Garcia',       'documento' => '20583778',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Martin Emiliano',       'apellido' => ' Galliano',       'documento' => '29033454',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Julio Berlin',       'apellido' => ' Gallegos castro',       'documento' => '93074556',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ignacio Ramon',       'apellido' => 'Gallardo',       'documento' => '28742325',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Alfredo',       'apellido' => 'G de la fuente',       'documento' => '25021311',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Gustavo Robinson',       'apellido' => 'Franco',       'documento' => '17609811',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Miguel Angel',       'apellido' => ' Fracalossi',       'documento' => '26017390',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Martin Enrique',       'apellido' => ' Flores',       'documento' => '24919732',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Carlos Alberto',       'apellido' => 'Flaquer',       'documento' => '29575390',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Javier Andres',       'apellido' => ' Figueroa',       'documento' => '32993318',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Guillermo Ramiro',       'apellido' => 'Ferrel',       'documento' => '28384562',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Federico Facundo',       'apellido' => ' Ferreira montiel',       'documento' => '31878725',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Toribio Oscar',       'apellido' => ' Fernandez',       'documento' => '13800456',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Sebastian Gabriel',       'apellido' => ' Fernandez',       'documento' => '33711508',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Mauricio Emanuel',       'apellido' => ' Fernandez',       'documento' => '29193885',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Luis Eduardo',       'apellido' => 'Fernandez',       'documento' => '18464432',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Leonardo Hector',       'apellido' => ' Fernandez',       'documento' => '25282286',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Jorge Cornelio',       'apellido' => ' Fernandez',       'documento' => '22810704',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Hernan Luis',       'apellido' => ' Fernandez',       'documento' => '18303578',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Gonzalo Fernando',       'apellido' => ' Fernandez',       'documento' => '26283851',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Antonio Alcides',       'apellido' => ' Fernandez',       'documento' => '17415726',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Fernando Adrian',       'apellido' => ' Feliu',       'documento' => '29922717',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Francisco Alberto',       'apellido' => 'Esteche',       'documento' => '20203502',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Maximiliano Enrique',       'apellido' => 'Espinola',       'documento' => '32842501',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Daniel Alberto',       'apellido' => ' Espinola',       'documento' => '26840344',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Elias Joaquin Rafael',       'apellido' => ' Espino',       'documento' => '94070456',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Diego Alejandro',       'apellido' => ' Espejo',       'documento' => '31176653',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Roberto Daniel',       'apellido' => 'Escobar',       'documento' => '28009469',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Fernando Alfredo',       'apellido' => ' Escobar',       'documento' => '21965118',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Mario Alfredo',       'apellido' => ' Escalada',       'documento' => '32060852',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Matias Sebastian',       'apellido' => 'Draguna',       'documento' => '29696232',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Nestor Daniel',       'apellido' => ' Dominguez',       'documento' => '32031503',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Augusto Javier',       'apellido' => ' Dominguez',       'documento' => '30359240',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Carlos Daniel',       'apellido' => ' Ditter',       'documento' => '22023875',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Sebastian Diego',       'apellido' => 'Diaz',       'documento' => '37604071',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Rodrigo Sebastian',       'apellido' => 'Diaz',       'documento' => '30963994',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Ricardo Alejandro',       'apellido' => ' Diaz',       'documento' => '25899831',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Ramon Dario',       'apellido' => ' Diaz',       'documento' => '32422725',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Olver Emanuel',       'apellido' => ' Diaz',       'documento' => '34392233',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Leonel Pedro',       'apellido' => ' Diaz',       'documento' => '30023506',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Leonardo Sergio',       'apellido' => ' Diaz',       'documento' => '26817371',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Jose Luis',       'apellido' => ' Diaz',       'documento' => '28374870',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Cristian Gabriel',       'apellido' => ' Diaz',       'documento' => '30198517',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Claudio Javier',       'apellido' => ' Diaz',       'documento' => '26867018',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Gustavo Adrian',       'apellido' => 'Dechigne',       'documento' => '23174765',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Gabino Jesus',       'apellido' => 'De los rios',       'documento' => '28731922',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Juan Manuel',       'apellido' => ' De la iglesia',       'documento' => '28674065',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Marcelino',       'apellido' => ' De jesus',       'documento' => '13816458',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Jose Alberto',       'apellido' => ' Cuti',       'documento' => '27988164',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jorge Leonardo',       'apellido' => 'Cueva',       'documento' => '26592211',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Hugo',       'apellido' => ' Cuenca',       'documento' => '18074805',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Sebastian Ricardo',       'apellido' => 'Cruz',       'documento' => '29274623',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Angel Nicolas',       'apellido' => ' Corvalan',       'documento' => '32983345',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Sergio Daniel',       'apellido' => ' Cortez',       'documento' => '26678966',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Jose Alejandro',       'apellido' => ' Correa',       'documento' => '28363174',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Juan Carlos',       'apellido' => ' Coronel',       'documento' => '24848344',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Adrian Alejandro',       'apellido' => 'Coronel',       'documento' => '33401990',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Nestor Alcides',       'apellido' => ' Coria',       'documento' => '17062439',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Jose Alberto',       'apellido' => ' Cordeiro',       'documento' => '20021883',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Oscar Roberto',       'apellido' => ' Corbalan',       'documento' => '20056059',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Sebastian',       'apellido' => ' Cora',       'documento' => '27373108',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Alejandro Oscar',       'apellido' => ' Contri',       'documento' => '31732494',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Sergio Fabian',       'apellido' => 'Compostella',       'documento' => '18379755',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Christian Sebastian',       'apellido' => ' Compostella',       'documento' => '23815749',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Marcelo Javier',       'apellido' => 'Colman',       'documento' => '29094439',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Emiliano Juan',       'apellido' => ' Collantes',       'documento' => '29238812',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Maximo Albino Emilio',       'apellido' => 'Cinat',       'documento' => '26823245',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Fernando Angel',       'apellido' => ' Cicero',       'documento' => '28755277',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Walter Ruben',       'apellido' => ' Chocobar',       'documento' => '31029901',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Juan Gabriel ',       'apellido' => ' Chazarreta',       'documento' => '29275104',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Ramiro German',       'apellido' => ' Cespedes',       'documento' => '32323030',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Pedro Enrique',       'apellido' => ' Centurion',       'documento' => '23014997',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Daniel Esteban',       'apellido' => ' Centurion',       'documento' => '22357440',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Alberto Carlos',       'apellido' => 'Centurion',       'documento' => '23420916',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Emiliano',       'apellido' => 'Centeno',       'documento' => '28282452',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Juan Jose',       'apellido' => ' Celaya',       'documento' => '28984312',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => '  Julio Omar',       'apellido' => ' Cejas barros',       'documento' => '35630091',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Christian Fabian Jacinto',       'apellido' => ' Ceballos',       'documento' => '36755355',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Adrian Alberto',       'apellido' => ' Castillo',       'documento' => '31807221',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Luis Alfredo',       'apellido' => ' Castellanos',       'documento' => '28803380',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Enrique Javier',       'apellido' => ' Castaño',       'documento' => '20416440',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Alejandro Ramon',       'apellido' => 'Casco',       'documento' => '24064979',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Hernan Alberto',       'apellido' => ' Casas',       'documento' => '34815262',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Mariano Marcelo Javier',       'apellido' => ' Carrizo',       'documento' => '26954843',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Jose Luis',       'apellido' => ' Carrizo',       'documento' => '25404133',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Walter Emilio Martin',       'apellido' => ' Carranza',       'documento' => '31819372',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Roberto Andres',       'apellido' => 'Cardozo',       'documento' => '25883288',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Esteban Vicente',       'apellido' => ' Canteros',       'documento' => '26971110',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Edgardo Francisco',       'apellido' => 'Canteros',       'documento' => '29169259',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Dario Victor',       'apellido' => ' Cano',       'documento' => '27729715',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Christian Daniel',       'apellido' => ' Campana',       'documento' => '22656891',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Luis Marcelo',       'apellido' => ' Camaño',       'documento' => '25435549',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Luis Alberto',       'apellido' => 'Cabrera',       'documento' => '23876032',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jorge David',       'apellido' => 'Cabrera',       'documento' => '31819322',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Alejandro Victor',       'apellido' => ' Cabrera',       'documento' => '18790641',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Alejandro Javier',       'apellido' => ' Cabrera',       'documento' => '30654933',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Diego Martin',       'apellido' => ' Cabral gonzalez',       'documento' => '92942723',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Jorge Fabian',       'apellido' => ' Caballero',       'documento' => '26530267',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Cristian Sebastian',       'apellido' => 'Caballero',       'documento' => '33128743',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Carlos Enrique',       'apellido' => 'Bustos',       'documento' => '20998892',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Elvio Adan',       'apellido' => ' Bustamante',       'documento' => '25473072',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Miguel Andres',       'apellido' => 'Burgos',       'documento' => '24960667',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Claudio Alberto',       'apellido' => ' Bulacio',       'documento' => '25839091',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Leonardo Jose',       'apellido' => 'Brunetto',       'documento' => '30963582',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Pablo Hernan',       'apellido' => ' Bringas',       'documento' => '30925155',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Carlos Alberto',       'apellido' => ' Brez',       'documento' => '25999237',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Javier Adrian',       'apellido' => ' Braico',       'documento' => '31283409',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Ricardo Walter',       'apellido' => ' Bordon',       'documento' => '16527654',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Matias Javier',       'apellido' => 'Bonfigli',       'documento' => '28382435',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Gabriel Gerardo',       'apellido' => ' Bogado',       'documento' => '27899107',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Andres Sebastian',       'apellido' => ' Bogado',       'documento' => '23619137',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Jorge Martin',       'apellido' => ' Blanco',       'documento' => '27180718',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Pablo Javier',       'apellido' => 'Billordo',       'documento' => '29272114',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Miguel Eugenio',       'apellido' => 'Benitez',       'documento' => '26325745',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Carlos Roberto',       'apellido' => ' Benitez',       'documento' => '30353263',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Jose Gustavo',       'apellido' => ' Benavidez',       'documento' => '20697722',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Alan Alberto',       'apellido' => 'Bell',       'documento' => '29028083',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Carlos Benjamin',       'apellido' => ' Baza',       'documento' => '28164939',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Cristian Leonel',       'apellido' => ' Bartoli',       'documento' => '26592726',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Oscar Claudio',       'apellido' => ' Barroso',       'documento' => '12094797',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jose Vicente',       'apellido' => 'Barrios',       'documento' => '13816530',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Edgardo Rodrigo',       'apellido' => ' Barrionuevo',       'documento' => '28181537',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Carlos Alberto',       'apellido' => ' Barrio',       'documento' => '31456110',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Carlos Nelson',       'apellido' => 'Barriento montiel',       'documento' => '31914394',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Manuel Roberto',       'apellido' => 'Barrera',       'documento' => '17450034',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Fernando Ignacio',       'apellido' => ' Barrera',       'documento' => '28807758',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Victor Hugo',       'apellido' => 'Barraza',       'documento' => '33108814',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Segundo Daniel',       'apellido' => ' Barraza',       'documento' => '18339299',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Daniel Benigno',       'apellido' => 'Barraza',       'documento' => '16544380',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Cristian Dario',       'apellido' => ' Balles',       'documento' => '26741512',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Daniel Oscar',       'apellido' => ' Baldivieso',       'documento' => '23508762',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Daniel Cesar',       'apellido' => ' Baigorria',       'documento' => '21175879',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Miguel Angel',       'apellido' => ' Baigorri',       'documento' => '27787582',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Juan Pedro Salomon',       'apellido' => ' Baigorri',       'documento' => '23475218',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Marcos Andres',       'apellido' => 'Baez',       'documento' => '25645166',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Carlos Javier',       'apellido' => ' Baez',       'documento' => '29636486',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Luis Alberto',       'apellido' => 'Ayras peralta',       'documento' => '93967129',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Pablo Martin',       'apellido' => ' Ayala',       'documento' => '30264677',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Juan Santiago',       'apellido' => 'Ayala',       'documento' => '28421359',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Claudio Ruben',       'apellido' => ' Ayala',       'documento' => '17357945',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Nelson Esteban',       'apellido' => 'Ayala vargas',       'documento' => '24963853',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Raul Horacio',       'apellido' => ' Avalos',       'documento' => '27372996',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Rodrigo Gaston',       'apellido' => 'Arzamendia',       'documento' => '25997040',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Nelson Cipriano',       'apellido' => ' Arzamendia',       'documento' => '21645655',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Mario Rene',       'apellido' => ' Arias',       'documento' => '30963384',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Francisco Damian',       'apellido' => ' Araya',       'documento' => '31550694',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Eduardo Marcelo',       'apellido' => 'Araujo',       'documento' => '17514354',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Sergio Ariel',       'apellido' => ' Aranda',       'documento' => '28737150',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Walter Daniel',       'apellido' => ' Aquino',       'documento' => '25978137',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Esteban Raul',       'apellido' => ' Aquino',       'documento' => '23793528',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Cristian Adrian',       'apellido' => ' Antesana',       'documento' => '30938918',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Cristian Alberto',       'apellido' => 'Andrada',       'documento' => '32378490',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jose',       'apellido' => 'Amarilla',       'documento' => '16089344',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Carlos Rodolfo',       'apellido' => ' Amarilla',       'documento' => '32263237',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jose Antonio',       'apellido' => 'Alvarez',       'documento' => '17899121',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Diego Hernan',       'apellido' => 'Alvarez',       'documento' => '28350774',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Martin Maximiliano',       'apellido' => ' Alvarez arreguez',       'documento' => '28422289',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Jorge Ramon',       'apellido' => ' Alvarenga',       'documento' => '21731547',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Pablo Alejandro',       'apellido' => 'Altamirano',       'documento' => '30020217',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Claudio Javier',       'apellido' => ' Almiron',       'documento' => '24226356',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Alex Daniel',       'apellido' => ' Almendras',       'documento' => '25370822',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Oscar Alberto',       'apellido' => 'Almanzar',       'documento' => '30825282',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Miguel Angel',       'apellido' => ' Alive',       'documento' => '30556150',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Raul Alberto',       'apellido' => ' Aliendre',       'documento' => '26134220',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Nestor Edgardo',       'apellido' => ' Alfaro',       'documento' => '29570000',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Maximiliano Fabian',       'apellido' => 'Alegre',       'documento' => '30912067',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Manuel Alejandro',       'apellido' => ' Alderete',       'documento' => '32791187',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' David Nicolas',       'apellido' => ' Alderete',       'documento' => '31350170',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Walter Alejandro',       'apellido' => ' Alba',       'documento' => '25419872',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Roberto Oscar',       'apellido' => ' Aguirre',       'documento' => '22196108',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Walter Ariel',       'apellido' => ' Aguilera',       'documento' => '25657026',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Diego Alberto',       'apellido' => ' Aguilera',       'documento' => '28719235',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Victor Ruben',       'apellido' => ' Aguero',       'documento' => '28808748',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Marcelo Matias',       'apellido' => ' Agostena',       'documento' => '31208625',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Hugo Sebastian',       'apellido' => ' Acuña',       'documento' => '32378453',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Daniel',       'apellido' => ' Acuña',       'documento' => '29432925',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Roberto',       'apellido' => ' Acosta',       'documento' => '22919000',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Benjamin',       'apellido' => ' Acosta vera',       'documento' => '92440897',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Cristian Eduardo',       'apellido' => ' Acosta ',       'documento' => '24581823',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Oscar David',       'apellido' => 'Acevedo',       'documento' => '34579814',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Juan Manuel',       'apellido' => 'Acevedo',       'documento' => '24540376',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => ' Adrian Heraldo',       'apellido' => ' Acevedo',       'documento' => '26950611',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Oscar Alejandro',       'apellido' => 'Calizaya',       'documento' => '25474641',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Rodrigo',       'apellido' => 'Melo',       'documento' => '32244393',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Javier Adrián',       'apellido' => 'Gomez',       'documento' => '28408563',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Claudio Ezequiel',       'apellido' => 'Toledo',       'documento' => '35993869',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Sebastián Jesús',       'apellido' => 'Figueroa',       'documento' => '30036765',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Heber Hugo',       'apellido' => 'Vera',       'documento' => '34437230',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Carlos Alberto',       'apellido' => 'Squillace',       'documento' => '18458620',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Gustavo Federico',       'apellido' => 'Sanchez',       'documento' => '32981919',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jaime Ramiro',       'apellido' => 'Peredo',       'documento' => '28709872',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Omar Alejandro',       'apellido' => 'Cantero',       'documento' => '29747450',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jonathan Federico',       'apellido' => 'Díaz',       'documento' => '35288102',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ricardo Daniel',       'apellido' => 'Altuman',       'documento' => '34078533',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Walter',       'apellido' => 'Tarragona',       'documento' => '40811749',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Matías',       'apellido' => 'Antúnez',       'documento' => '34141755',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Luis Alberto',       'apellido' => 'Nuñez',       'documento' => '29899187',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Eric Alberto',       'apellido' => 'Ledesma',       'documento' => '37289478',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Ariel Alejandro',       'apellido' => 'Stoppiello',       'documento' => '36150024',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Rolando Roberto',       'apellido' => 'Alonso',       'documento' => '22853665',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Leandro',       'apellido' => 'Cisterna silva',       'documento' => '37204586',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Juan Darío',       'apellido' => 'Ríos',       'documento' => '27397976',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Félix',       'apellido' => 'Herrera',       'documento' => '12978614',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Domingo Luis',       'apellido' => 'Reyes',       'documento' => '32663319',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Mario Alejandro',       'apellido' => 'Pérez',       'documento' => '26748306',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Pablo Francisco',       'apellido' => 'Rodrìguez',       'documento' => '30677234',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Juan José',       'apellido' => 'Piuca',       'documento' => '23330341',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Gustavo Carlos',       'apellido' => 'Paredes meruvia',       'documento' => '93999881',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Aníbal Daniel',       'apellido' => 'Velázquez',       'documento' => '31796224',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Juan Carlos',       'apellido' => 'Gamboa',       'documento' => '30724892',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Claudio Gerardo',       'apellido' => 'Martínez',       'documento' => '29076590',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Guido Hernán',       'apellido' => 'Bucich',       'documento' => '28384731',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Diego Omar',       'apellido' => 'Alaniz',       'documento' => '23768810',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'David Ezequiel',       'apellido' => 'Sanchez',       'documento' => '33832843',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Cristian Aníbal',       'apellido' => 'Lopez',       'documento' => '25148973',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jose Luis',       'apellido' => 'Rocha',       'documento' => '17062718',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jorge Oscar',       'apellido' => 'Ibarra',       'documento' => '21977038',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Gerardo Miguel',       'apellido' => 'Pereyra',       'documento' => '32443337',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Julio César',       'apellido' => 'Pérez',       'documento' => '20001793',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Maximiliano Marcelino Ezequiel',       'apellido' => 'Fernández',       'documento' => '34407719',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Santiago Nahuel',       'apellido' => 'Frete',       'documento' => '37123184',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Fernando Marcelo',       'apellido' => 'Martínez',       'documento' => '25915382',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Francisco Benjamín',       'apellido' => 'Bandeira',       'documento' => '28899891',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Hernán Ariel',       'apellido' => 'Camacho',       'documento' => '27257950',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Maximiliano José',       'apellido' => 'Cardenas',       'documento' => '30065895',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Hernán Maximiliano',       'apellido' => 'Barrientos villareal',       'documento' => '30794794',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Mariano Edgardo',       'apellido' => 'Gomez',       'documento' => '34216436',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Rubén Ángel',       'apellido' => 'Leiba',       'documento' => '29096230',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Carlos Leonel',       'apellido' => 'Ledesma',       'documento' => '33748882',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Lucas',       'apellido' => 'Jose',       'documento' => '36764655',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Pablo Ariel',       'apellido' => 'Roldan',       'documento' => '24679554',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Leonardo Jose',       'apellido' => 'Romero',       'documento' => '33710532',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Juan Domingo',       'apellido' => 'Diaz',       'documento' => '23475026',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Julio Andrés',       'apellido' => 'Idiart',       'documento' => '25797845',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Vicente',       'apellido' => 'Cardozo',       'documento' => '26140671',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Omar Dario',       'apellido' => 'Raffo',       'documento' => '21439162',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Marcelo Roberto',       'apellido' => 'Arizaga enríquez',       'documento' => '93748037',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Monica Trinidad',       'apellido' => 'Corvalan',       'documento' => '25875866',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Diego',       'apellido' => 'Duarte',       'documento' => '28739770',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Veronica Andrea',       'apellido' => 'Caro',       'documento' => '25678229',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jose Luis',       'apellido' => 'Torres',       'documento' => '24935817',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Victor Hugo',       'apellido' => 'Mendoza',       'documento' => '32032129',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Cristian Damian',       'apellido' => 'Goncalves',       'documento' => '29157411',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Víctor José',       'apellido' => 'Gallardo',       'documento' => '28743998',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Marcelo Walter',       'apellido' => 'Abdala',       'documento' => '22494431',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Matías',       'apellido' => 'Rodriguez ferreira',       'documento' => '92635709',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jorge Adrián',       'apellido' => 'Peralta',       'documento' => '38960021',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Mauro Lionel',       'apellido' => 'Medina',       'documento' => '32006028',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jorge Armando',       'apellido' => 'Barreto',       'documento' => '29600923',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Aníbal Raúl',       'apellido' => 'Liberatori',       'documento' => '20539878',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Cristian Jorge',       'apellido' => 'Pereyra',       'documento' => '24022885',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Sebastían Rodrigo',       'apellido' => 'Villarreal',       'documento' => '27089641',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Narciso Jorge Luis',       'apellido' => 'Chunga',       'documento' => '93903202',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Rolando Emmanuel',       'apellido' => 'Ayala',       'documento' => '32007121',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Orlando Eduardo',       'apellido' => 'Alvarado',       'documento' => '22028230',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Pablo Airel',       'apellido' => 'Roldan',       'documento' => '24179131',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Celso Osvaldo',       'apellido' => 'Catan',       'documento' => '14181975',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Cristian Alejandro',       'apellido' => 'Pastrana',       'documento' => '30654611',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jorge Alfredo',       'apellido' => 'Funes',       'documento' => '23200185',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Cristian Sebastián',       'apellido' => 'Ayala',       'documento' => '33813494',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jorge Luis',       'apellido' => 'Agout',       'documento' => '26866762',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Roberto Elías',       'apellido' => 'Segundo',       'documento' => '24360248',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Rodrigo Nicolás',       'apellido' => 'Pellegrini',       'documento' => '36274371',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Darío Alejandro',       'apellido' => 'Lopez',       'documento' => '33419904',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Rubén Luis',       'apellido' => 'Palavecino',       'documento' => '21791596',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Luis Esteban',       'apellido' => 'Rocha',       'documento' => '31641923',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Pablo César',       'apellido' => 'Rodriguez',       'documento' => '28061898',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Rodolfo Eduardo',       'apellido' => 'Ortiz',       'documento' => '20090605',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Fernando Martín',       'apellido' => 'Hurtado',       'documento' => '29271425',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Roberto Roque',       'apellido' => 'Díaz',       'documento' => '21625836',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Marcelo Gustavo',       'apellido' => 'Centurión',       'documento' => '26009338',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'José Sebastián',       'apellido' => 'Capozzi',       'documento' => '29370467',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Damián Ariel',       'apellido' => 'Carrizo',       'documento' => '33777667',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Adrián Oscar',       'apellido' => 'Delgado',       'documento' => '27151717',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jose Miguel',       'apellido' => 'De la pina',       'documento' => '27627569',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'César Roger',       'apellido' => 'Palavecino douglas',       'documento' => '31190996',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Jose Luis',       'apellido' => 'Flores',       'documento' => '24146302',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Angel Norberto',       'apellido' => 'Coronel',       'documento' => '24935103',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Andrés Alfonso',       'apellido' => 'Mieres',       'documento' => '18375269',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Pablo Adrian',       'apellido' => 'Acevedo',       'documento' => '27236854',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Leandro Gabriel',       'apellido' => 'Torres',       'documento' => '36237975',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Christian Augusto',       'apellido' => 'Carrizo',       'documento' => '23770024',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);
      Trabajador::create([       'nombre' => 'Sebastián Cristian',       'apellido' => 'Lamas',       'documento' => '29022070',     'empresa_id' => '2',       'created_at' => Carbon::now(),       'updated_at' => Carbon::now(),   ]);


  
      PrestacionFarmaciaDroga::create([
        'nombre' => 'Ibuprofeno 600mg',
        'via_prestacion' => 'VO',
        'prestacion_droga_tipo_id' => 1,
        'empresa_id' => 2,
        'cantidad' => 1
    ]);

    PrestacionFarmaciaDroga::create([
        'nombre' => 'Ibuprofeno 400mg',
        'via_prestacion' => 'VO',
        'prestacion_droga_tipo_id' => 1,
        'empresa_id' => 2,
        'cantidad' => 4
    ]);

    PrestacionFarmaciaDroga::create([
        'nombre' => 'Paracetamol 500mg',
        'via_prestacion' => 'VO',
        'prestacion_droga_tipo_id' => 1,
        'empresa_id' => 2,
        'cantidad' => 56
    ]);

    PrestacionFarmaciaDroga::create([
        'nombre' => 'Aspirina 100mg',
        'via_prestacion' => 'VO',
        'prestacion_droga_tipo_id' => 1,
        'empresa_id' => 2,
        'cantidad' => 98
    ]);

    PrestacionFarmaciaDroga::create([
        'nombre' => 'Diclofenaco 50mg',
        'via_prestacion' => 'VO',
        'prestacion_droga_tipo_id' => 1,
        'empresa_id' => 2,
        'cantidad' => 12
    ]);

    PrestacionFarmaciaDroga::create([
        'nombre' => 'Diclofenaco 75 mg',
        'via_prestacion' => 'VO',
        'prestacion_droga_tipo_id' => 1,
        'empresa_id' => 2,
        'cantidad' => 12
    ]);

    PrestacionFarmaciaDroga::create([
        'nombre' => 'Diclofenaco 50mg + Pridinol 4mg',
        'via_prestacion' => 'VO',
        'prestacion_droga_tipo_id' => 1,
        'empresa_id' => 2,
        'cantidad' => 12
    ]);


      


    }
}
