<?php

use App\Models\Sector;
use App\Models\Empresa;
use App\Models\Localidad;
use App\Models\Proveedor;
use App\Models\Remitente;
use App\Models\Enfermedad;

use App\Models\ConsultaTipo;
use App\Models\AusentismoTipo;
use App\Models\ConsultaReposo;
use App\Models\PrestacionTipo;
use App\Models\TipoIncidencia;
use App\Models\ComunicacionTipo;
use App\Models\ModoComunicacion;
use App\Models\DocumentacionTipo;
use App\Models\DocumentacionEmpresaTipo;

use App\Models\MotivoComunicacion;
use App\Models\RemitenteComunicacion;



use App\Models\Trabajador;


use Carbon\Carbon;

use Illuminate\Database\Seeder;
use App\User;

use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {




//               USUARIOS POR DEFECTO                     //

        $user = User::create([
            'username' => 'wakielo',
            'nombre' => 'Nicolás',
            'apellido' => 'Benito Arango',
            'email' => 'admin@gmail.com',
            'telefono' => '1137870294',
            'password' => Hash::make('123456789'),
            'photo' => 'niko.jpg',
            'is_empresa' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $user->assignRole(1);

        $use_empresa1 = User::create([
            'username' => 'diego_fosco',
            'nombre' => 'Diego',
            'apellido' => 'Fosco',
            'email' => 'diego_fosco@ejornal.com.ar',
            'telefono' => '1158378374',
            'password' => Hash::make('diego_fosco'),
            'photo' => 'diego.jpg',
            'is_empresa' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $use_empresa1->assignRole(1);
        $use_empresa1->empresas()->sync([1,2,3,4,7]);



        $use_empresa2 = User::create([
            'username' => 'benito_arango',
            'nombre' => 'Nicolás',
            'apellido' => 'Benito Arango',
            'email' => 'benito_arango@ejornal.com.ar',
            'telefono' => '1137870294',
            'password' => Hash::make('benito_arango'),
            'photo' => 'niko.jpg',
            'is_empresa' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $use_empresa2->assignRole(8);
        $use_empresa2->empresas()->sync([1,2]);

        $use_empresa3 = User::create([
            'username' => 'gabriela_benitez',
            'nombre' => 'Gabriela',
            'apellido' => 'Benitez',
            'email' => 'gabriela_benitez@ejornal.com.ar',
            'telefono' => '1157402974',
            'password' => Hash::make('gabriela_benitez'),
            'photo' => 'gabriela.jpeg',
            'is_empresa' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $use_empresa3->assignRole(6);
        $use_empresa3->empresas()->sync([1,2]);

        $use_empresa4 = User::create([
            'username' => 'patri_viollaz',
            'nombre' => 'Patricia',
            'apellido' => 'Viollaz',
            'email' => 'patri_viollaz@ejornal.com.ar',
            'telefono' => '1122894182',
            'password' => Hash::make('patri_viollaz'),
            'photo' => 'patri.jpeg',
            'is_empresa' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $use_empresa4->assignRole(6);
        $use_empresa4->empresas()->sync([1,2]);

        $use_empresa5 = User::create([
            'username' => 'pedro_escobar',
            'nombre' => 'Pedro',
            'apellido' => 'Escobar',
            'email' => 'pedro_escobar@ejornal.com.ar',
            'telefono' => '1141611380',
            'password' => Hash::make('pedro_escobar'),
            'photo' => 'pedro.jpeg',
            'is_empresa' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $use_empresa5->assignRole(6);
        $use_empresa5->empresas()->sync([1,2]);

        $use_empresa6 = User::create([
            'username' => 'vivi_semecurbe',
            'nombre' => 'Viviana',
            'apellido' => 'Semecurbe',
            'email' => 'vivi_semecurbe@ejornal.com.ar',
            'telefono' => '1134690416',
            'password' => Hash::make('vivi_semecurbe'),
            'photo' => 'vivi.jpeg',
            'is_empresa' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $use_empresa6->assignRole(6);
        $use_empresa6->empresas()->sync([1,2]);



        $use_empresa7 = User::create([
            'username' => 'veronica_diez',
            'nombre' => 'Veronica',
            'apellido' => 'Diez',
            'email' => 'veronicadiez@ejornal.com.ar',
            'telefono' => '1122858586',
            'password' => Hash::make('veronica_diez'),
            'photo' => 'adminlte/img/avata_1.png',
            'photo' => 'vero.jpeg',
            'is_empresa' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $use_empresa7->assignRole(2);
        $use_empresa7->empresas()->sync([1]);

        $use_empresa8 = User::create([
            'username' => 'maria_alonso',
            'nombre' => 'Maria',
            'apellido' => 'Alonso',
            'telefono' => '1161746367',
            'email' => 'mariaalonso@ejornal.com.ar',
            'password' => Hash::make('maria_alonso'),
            'photo' => 'maria.jpeg',
            'is_empresa' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $use_empresa8->assignRole(2);
        $use_empresa8->empresas()->sync([1]);

        $use_empresa9 = User::create([
            'username' => 'mauro_gomez',
            'nombre' => 'Mauro',
            'apellido' => 'Gomez',
            'email' => 'maurogomez@ejornal.com.ar',
            'telefono' => '1144484368',
            'password' => Hash::make('mauro_gomez'),
            'photo' => 'mauro.jpeg',
            'is_empresa' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $use_empresa9->assignRole(1);
        $use_empresa9->empresas()->sync([1,2,3,7]);



        $use_empresa10 = User::create([
            'username' => 'ariel_lucero',
            'nombre' => 'Ariel',
            'apellido' => 'Lucero',
            'email' => 'ariel_lucero@ejornal.com.ar',
            'telefono' => '1166553361',
            'password' => Hash::make('ariel_lucero'),
            'photo' => 'ariel.jpeg',
            'is_empresa' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $use_empresa10->assignRole(9);
        $use_empresa10->empresas()->sync([1,5]);


        $use_empresa11 = User::create([
            'username' => 'alejandra_diaz',
            'nombre' => 'Alejandra',
            'apellido' => 'Diaz',
            'email' => 'alejandra_diaz@ejornal.com.ar',
            'telefono' => '1133637459',
            'password' => Hash::make('alejandra_diaz'),
            'photo' => 'alejandra.jpeg',
            'is_empresa' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $use_empresa11->assignRole(5);
        $use_empresa11->empresas()->sync([1,4]);

        $use_empresa12 = User::create([
            'username' => 'Fernando Martinez',
            'nombre' => 'Fernando',
            'apellido' => 'Martinez',
            'email' => 'fernando_martinez@ejornal.com.ar',
            'telefono' => '11548741',
            'password' => Hash::make('fernando_martinez'),
            'photo' => 'fernando.jpeg',
            'is_empresa' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $use_empresa12->assignRole(5);
        $use_empresa12->empresas()->sync([1,2]);

              $use_empresa2 = User::create([
            'username' => 'federico_fortte',
            'nombre' => 'Federico',
            'apellido' => 'Fortte',
            'email' => 'federico_fortte@ejornal.com.ar',
            'telefono' => '1158971477',
            'password' => Hash::make('federico_fortte'),
            'photo' => 'federico.jpg',
            'is_empresa' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $use_empresa2->assignRole(8);
        $use_empresa2->empresas()->sync([1,2]);

              $use_empresa2 = User::create([
            'username' => 'emilia_roulier',
            'nombre' => 'Emilia',
            'apellido' => 'Roulier',
            'email' => 'emilia_roulier@ejornal.com.ar',
            'telefono' => '1234567890',
            'password' => Hash::make('emilia_roulier'),
            'photo' => 'emilia.jpg',
            'is_empresa' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $use_empresa2->assignRole(8);
        $use_empresa2->empresas()->sync([1,3]);







        ConsultaReposo::create([
            'nombre' => 'No amerita'
        ]);

        ConsultaReposo::create([
            'nombre' => '24 horas'
        ]);

        ConsultaReposo::create([
            'nombre' => '48 horas'
        ]);

        ConsultaReposo::create([
            'nombre' => '72 horas'
        ]);

        ConsultaReposo::create([
            'nombre' => '96 horas'
        ]);

        ConsultaReposo::create([
            'nombre' => '1 semana'
        ]);

        ConsultaReposo::create([
            'nombre' => '1 mes'
        ]);

        ConsultaReposo::create([
            'nombre' => 'Indeterminado'
        ]);

        ConsultaReposo::create([
            'nombre' => 'Salida'
        ]);


        Remitente::create([
            'nombre' => 'El mismo'
        ]);

        Remitente::create([
            'nombre' => 'Familiar'
        ]);

        Remitente::create([
            'nombre' => 'Buzon de voz'
        ]);

        Remitente::create([
            'nombre' => 'RRHH'
        ]);

        Remitente::create([
            'nombre' => 'Delegado'
        ]);


        MotivoComunicacion::create([
            'nombre' => 'Inasistencia laboral'
        ]);

        MotivoComunicacion::create([
            'nombre' => 'Asistencia especialista médico'
        ]);

        MotivoComunicacion::create([
            'nombre' => 'Nueva consulta ART'
        ]);

        MotivoComunicacion::create([
            'nombre' => 'Autodenuncia ART'
        ]);
        MotivoComunicacion::create([
            'nombre' => 'Donación sangre'
        ]);
        MotivoComunicacion::create([
            'nombre' => 'Salida antes de horario'
        ]);
        MotivoComunicacion::create([
            'nombre' => 'Fichaje despues de horario'
        ]);

        MotivoComunicacion::create([
            'nombre' => 'Otros'
        ]);

        RemitenteComunicacion::create([
            'nombre' => 'El mismo'
        ]);
        RemitenteComunicacion::create([
            'nombre' => 'Familiar'
        ]);

        RemitenteComunicacion::create([
            'nombre' => 'Delegado'
        ]);
        RemitenteComunicacion::create([
            'nombre' => 'RRHH'
        ]);

        ComunicacionTipo::create([
            'nombre' => 'Médica'
        ]);

        ComunicacionTipo::create([
            'nombre' => 'Enfermeria'
        ]);

        ComunicacionTipo::create([
            'nombre' => 'Incidencia'
        ]);

          AusentismoTipo::create([
            'nombre' => 'Accidente laboral'
        ]);

        AusentismoTipo::create([
            'nombre' => 'Enfermedad laboral'
        ]);

        AusentismoTipo::create([
            'nombre' => 'Enfermedad inculpable'
        ]);

        AusentismoTipo::create([
            'nombre' => 'Embarazo'
        ]);

        AusentismoTipo::create([
            'nombre' => 'Lactancia'
        ]);

        AusentismoTipo::create([
            'nombre' => 'Estudios médicos'
        ]);
        AusentismoTipo::create([
            'nombre' => 'Familiar enfermo'
        ]);
      
      
      
      
      
      
 
  


        ConsultaTipo::create([
            'nombre' => 'Medicina'
        ]);

        ConsultaTipo::create([
            'nombre' => 'Enfermeria'
        ]);

        DocumentacionTipo::create([
            'nombre' => 'Certificado baja laboral'
        ]);

        DocumentacionTipo::create([
            'nombre' => 'Certificado alta médica'
        ]);

        DocumentacionTipo::create([
            'nombre' => 'Certificado alta ART'
        ]);

        DocumentacionTipo::create([
            'nombre' => 'Informe médico'
        ]);


        Enfermedad::create([
            'nombre' => 'Diabetes',
            'tipo' => 3
        ]);

        Enfermedad::create([
            'nombre' => 'Asma',
            'tipo' => 3
        ]);

        Enfermedad::create([
            'nombre' => 'HTA',
            'tipo' => 3
        ]);

        Enfermedad::create([
            'nombre' => 'Chagas',
            'tipo' => 3
        ]);

        Enfermedad::create([
            'nombre' => 'Dislipemia',
            'tipo' => 3
        ]);
        Enfermedad::create([
            'nombre' => 'Ca. colon',
            'tipo' => 3
        ]);

        Enfermedad::create([
            'nombre' => 'Ca. pulmon',
            'tipo' => 3
        ]);

        Enfermedad::create([
            'nombre' => 'Ca. mama',
            'tipo' => 3
        ]);


        Enfermedad::create([
            'nombre' => 'Asma',
            'tipo' => 1
        ]);
        Enfermedad::create([
            'nombre' => 'HTA',
            'tipo' => 1
        ]);

        Enfermedad::create([
            'nombre' => 'Enfermedades mentales',
            'tipo' => 1
        ]);

        Enfermedad::create([
            'nombre' => 'Obesidad',
            'tipo' => 1
        ]);


        Enfermedad::create([
            'nombre' => 'Sedentarismo',
            'tipo' => 2
        ]);

        Enfermedad::create([
            'nombre' => 'Tabaquismo',
            'tipo' => 2
        ]);

        Enfermedad::create([
            'nombre' => 'Alcohol',
            'tipo' => 2
        ]);


        Localidad::create([
            'nombre' => '25 de Mayo'
        ]);

        ModoComunicacion::create([
            'nombre' => 'Personalmente'
        ]);

        ModoComunicacion::create([
            'nombre' => 'Llamada telefonica'
        ]);

        ModoComunicacion::create([
            'nombre' => 'SMS'
        ]);

        ModoComunicacion::create([
            'nombre' => 'Contestador automático'
        ]);

        PrestacionTipo::create([
            'nombre' => 'Ambulancia',
             'tipo' => 't'
        ]);

        PrestacionTipo::create([
            'nombre' => 'Ecografía',
             'tipo' => 't'
        ]);



        PrestacionTipo::create([
            'nombre' => 'Farmacia'
        ]);

        PrestacionTipo::create([
            'nombre' => 'Abono servicio médico'
        ]);
        PrestacionTipo::create([
            'nombre' => 'Abono visita médica'
        ]);
        PrestacionTipo::create([
            'nombre' => 'Area Protegida'
        ]);
        PrestacionTipo::create([
            'nombre' => 'Capacitacion'
        ]);
        PrestacionTipo::create([
            'nombre' => 'Consultorio externo'
        ]);
         PrestacionTipo::create([
            'nombre' => 'Enfermero'
        ]);
         PrestacionTipo::create([
            'nombre' => 'Médico'
        ]);
         PrestacionTipo::create([
            'nombre' => 'Hora enfermería'
        ]);
        PrestacionTipo::create([
            'nombre' => 'Hora médico'
        ]);
        PrestacionTipo::create([
            'nombre' => 'Interconsulta',
             'tipo' => 't'
        ]);
        PrestacionTipo::create([
            'nombre' => 'Junta médica',
             'tipo' => 't'
        ]);
        PrestacionTipo::create([
            'nombre' => 'Libretas sanitarias'
        ]);
         PrestacionTipo::create([
            'nombre' => 'Peritaje Médico Legista'
        ]);
        PrestacionTipo::create([
            'nombre' => 'Residuos patológicos'
        ]);
        PrestacionTipo::create([
            'nombre' => 'Vacunación'
        ]);

        PrestacionTipo::create([
            'nombre' => 'Visita médica excedente'
        ]);
        PrestacionTipo::create([
            'nombre' => 'Visita médica individual'
        ]);
         PrestacionTipo::create([
            'nombre' => 'Medico a domicilio',
             'tipo' => 't'
        ]);       PrestacionTipo::create([
            'nombre' => 'Médico especialista en traumatólogia',
             'tipo' => 't'
        ]);

        PrestacionTipo::create([
            'nombre' => 'Médico especialista en medicina legal y forense',
             'tipo' => 't'
        ]);

        PrestacionTipo::create([
            'nombre' => 'Médico especialista en psiquiatria',
             'tipo' => 't'
        ]);


        PrestacionTipo::create([
            'nombre' => 'Radiografía',
             'tipo' => 't'
        ]);

        PrestacionTipo::create([
            'nombre' => 'Resonancia magnética',
             'tipo' => 't'
        ]);      
        Proveedor::create([
            'nombre' => 'Dr. Nestor Calla',
            'descripcion' => 'Medico a domicilio Zona Sur',
            'prestacion_tipo_id' => 1,
            'email' => 'dr.callanestor@gmail.com',
            'telefono' => '1566807391'
        ]);

        TipoIncidencia::create([
            'nombre' => 'Accidente'
        ]);
     TipoIncidencia::create([
            'nombre' => 'Accidente in itinere'
        ]);
        TipoIncidencia::create([
            'nombre' => 'Incidente'
        ]);


        DocumentacionEmpresaTipo::create([
            'nombre' => 'Comunicación'
        ]);
        DocumentacionEmpresaTipo::create([
            'nombre' => 'Guías'
        ]);
        DocumentacionEmpresaTipo::create([
            'nombre' => 'Manuales'
        ]);
        DocumentacionEmpresaTipo::create([
            'nombre' => 'Constancia'
        ]);      


    }
}
