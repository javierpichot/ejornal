<?php

use App\Models\ConsultaMotivo;
use App\Models\Diagnostico;


use Carbon\Carbon;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class EspecialidadDiagnosticoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        ConsultaMotivo::create([ 'nombre' => 'CARDIOVASCULAR' ]);
        ConsultaMotivo::create([ 'nombre' => 'DIGESTIVO' ]);
        ConsultaMotivo::create([ 'nombre' => 'NERVIOSO' ]);
        ConsultaMotivo::create([ 'nombre' => 'EXCRETOR/URINARIO' ]);
        ConsultaMotivo::create([ 'nombre' => 'LOCOMOTOR' ]);
        ConsultaMotivo::create([ 'nombre' => 'RESPIRATORIO' ]);
        ConsultaMotivo::create([ 'nombre' => 'REPRODUCTOR' ]);
        ConsultaMotivo::create([ 'nombre' => 'ENDOCRINO METABOLICO' ]);
        ConsultaMotivo::create([ 'nombre' => 'CONSULTA COMUN' ]);
        ConsultaMotivo::create([ 'nombre' => 'SALUD MENTAL' ]);
        ConsultaMotivo::create([ 'nombre' => 'ODONTOLOGIA' ]);
        ConsultaMotivo::create([ 'nombre' => 'OFTALMOLOGIA' ]);
        ConsultaMotivo::create([ 'nombre' => 'DERMATOLOGIA' ]);
        ConsultaMotivo::create([ 'nombre' => 'OTROS' ]);


        Diagnostico::create([ 'diagnostico' => 'HTA' , 'consulta_motivo_id' => '1',          'guia'=> 'guia.pdf',
        'cuidados'=> 'cuidados.pdf',]);
        Diagnostico::create([ 'diagnostico' => 'TAQUICARDIA', 'consulta_motivo_id' => '1']);
        Diagnostico::create([ 'diagnostico' => 'BRADICARDIA' ,'consulta_motivo_id' => '1']);
        Diagnostico::create([ 'diagnostico' => 'ARRITMIA' ,'consulta_motivo_id' => '1']);
        Diagnostico::create([ 'diagnostico' => 'IAM' ,'consulta_motivo_id' => '1']);
        Diagnostico::create([ 'diagnostico' => 'PRECORDALGIA TIPICA', 'consulta_motivo_id' => '1']);
        Diagnostico::create([ 'diagnostico' => 'PRECORDALGIA ATIPICA' ,'consulta_motivo_id' => '1']);
        Diagnostico::create([ 'diagnostico' => 'TUMORES' ,'consulta_motivo_id' => '1']);
        Diagnostico::create([ 'diagnostico' => 'CIRUGIA', 'consulta_motivo_id' => '1']);
        Diagnostico::create([ 'diagnostico' => 'OTROS' ,'consulta_motivo_id' => '1']);

        Diagnostico::create([ 'diagnostico' => 'GASTRITIS / SINDROME ACIDO SENSITIVO','consulta_motivo_id' => '2']);
        Diagnostico::create([ 'diagnostico' => 'GASTROENTEROCOLITIS','consulta_motivo_id' => '2']);
        Diagnostico::create([ 'diagnostico' => 'VOMITOS','consulta_motivo_id' => '2']);
        Diagnostico::create([ 'diagnostico' => 'DIARREA','consulta_motivo_id' => '2']);
        Diagnostico::create([ 'diagnostico' => 'HEMORROIDES','consulta_motivo_id' => '2']);
        Diagnostico::create([ 'diagnostico' => 'DIVERTICULOSIS','consulta_motivo_id' => '2']);
        Diagnostico::create([ 'diagnostico' => 'COLON IRRITABLE','consulta_motivo_id' => '2']);
        Diagnostico::create([ 'diagnostico' => 'TUMORES','consulta_motivo_id' => '2']);
        Diagnostico::create([ 'diagnostico' => 'CIRUGIA','consulta_motivo_id' => '2']);
        Diagnostico::create([ 'diagnostico' => 'OTROS','consulta_motivo_id' => '2']);
        Diagnostico::create([ 'diagnostico' => 'DOLOR ABDOMINAL','consulta_motivo_id' => '2']);
        Diagnostico::create([ 'diagnostico' => 'CONSTIPACION','consulta_motivo_id' => '2']);
        Diagnostico::create([ 'diagnostico' => 'ACV','consulta_motivo_id' => '3']);
        Diagnostico::create([ 'diagnostico' => 'EPILEPSIA','consulta_motivo_id' => '3']);
        Diagnostico::create([ 'diagnostico' => 'NEUROPATIAS','consulta_motivo_id' => '3']);
        Diagnostico::create([ 'diagnostico' => 'INFECCIONES','consulta_motivo_id' => '3']);
        Diagnostico::create([ 'diagnostico' => 'TUMORES','consulta_motivo_id' => '3']);
        Diagnostico::create([ 'diagnostico' => 'CIRUGIA','consulta_motivo_id' => '3']);
        Diagnostico::create([ 'diagnostico' => 'OTROS','consulta_motivo_id' => '3']);
        Diagnostico::create([ 'diagnostico' => 'INFECCION URINARIA','consulta_motivo_id' => '4']);
        Diagnostico::create([ 'diagnostico' => 'PIELONEFRITIS','consulta_motivo_id' => '4']);
        Diagnostico::create([ 'diagnostico' => 'COLICO RENAL / LITIASIS','consulta_motivo_id' => '4']);
        Diagnostico::create([ 'diagnostico' => 'INSUFICIENCIA RENAL','consulta_motivo_id' => '4']);
        Diagnostico::create([ 'diagnostico' => 'TUMORES','consulta_motivo_id' => '4']);
        Diagnostico::create([ 'diagnostico' => 'CIRUGIA','consulta_motivo_id' => '4']);
        Diagnostico::create([ 'diagnostico' => 'OTROS','consulta_motivo_id' => '4']);
        Diagnostico::create([ 'diagnostico' => 'CERVICALGIA','consulta_motivo_id' => '5']);
        Diagnostico::create([ 'diagnostico' => 'OMALGIA','consulta_motivo_id' => '5']);
        Diagnostico::create([ 'diagnostico' => 'DORSALGIA','consulta_motivo_id' => '5']);
        Diagnostico::create([ 'diagnostico' => 'LUMBALGIA / LUMBOCIATALGIA','consulta_motivo_id' => '5']);
        Diagnostico::create([ 'diagnostico' => 'GONALGIA','consulta_motivo_id' => '5']);
        Diagnostico::create([ 'diagnostico' => 'CRURALGIA','consulta_motivo_id' => '5']);
        Diagnostico::create([ 'diagnostico' => 'TALALGIA','consulta_motivo_id' => '5']);
        Diagnostico::create([ 'diagnostico' => 'COXALGIA','consulta_motivo_id' => '5']);
        Diagnostico::create([ 'diagnostico' => 'FRACTURA','consulta_motivo_id' => '5']);
        Diagnostico::create([ 'diagnostico' => 'CONTUSION','consulta_motivo_id' => '5']);
        Diagnostico::create([ 'diagnostico' => 'CIRUGIA','consulta_motivo_id' => '5']);
        Diagnostico::create([ 'diagnostico' => 'TENDINITIS / TENDINOSIS','consulta_motivo_id' => '5']);
        Diagnostico::create([ 'diagnostico' => 'HERNIA DISCAL','consulta_motivo_id' => '5']);
        Diagnostico::create([ 'diagnostico' => 'DISTENSION','consulta_motivo_id' => '5']);
        Diagnostico::create([ 'diagnostico' => 'OTROS','consulta_motivo_id' => '5']);
        Diagnostico::create([ 'diagnostico' => 'OTRAS ALGIAS','consulta_motivo_id' => '5']);
        Diagnostico::create([ 'diagnostico' => 'TUNEL CARPIANO','consulta_motivo_id' => '5']);
        Diagnostico::create([ 'diagnostico' => 'INSUFICIENCIA RESPIRATORIA','consulta_motivo_id' => '6']);
        Diagnostico::create([ 'diagnostico' => 'FARINGITIS / FARINGOAMIGDALITIS','consulta_motivo_id' => '6']);
        Diagnostico::create([ 'diagnostico' => 'RINITIS / SINUSITIS','consulta_motivo_id' => '6']);
        Diagnostico::create([ 'diagnostico' => 'LARINGITIS','consulta_motivo_id' => '6']);
        Diagnostico::create([ 'diagnostico' => 'BRONCOPATIA','consulta_motivo_id' => '6']);
        Diagnostico::create([ 'diagnostico' => 'ASMA / BRONCOESPASMOS','consulta_motivo_id' => '6']);
        Diagnostico::create([ 'diagnostico' => 'TUMORES','consulta_motivo_id' => '6']);
        Diagnostico::create([ 'diagnostico' => 'CIRUGIA','consulta_motivo_id' => '6']);
        Diagnostico::create([ 'diagnostico' => 'NEUMONIA','consulta_motivo_id' => '6']);
        Diagnostico::create([ 'diagnostico' => 'EPOC','consulta_motivo_id' => '6']);
        Diagnostico::create([ 'diagnostico' => 'OTROS' ,'consulta_motivo_id' => '6']);
        Diagnostico::create([ 'diagnostico' => 'VARICOCELE','consulta_motivo_id' => '7']);
        Diagnostico::create([ 'diagnostico' => 'VULVOVAGINITIS / BARTHOLINITIS','consulta_motivo_id' => '7']);
        Diagnostico::create([ 'diagnostico' => 'ORQUITIS / URETRITIS','consulta_motivo_id' => '7']);
        Diagnostico::create([ 'diagnostico' => 'OTRAS INFECCIONES','consulta_motivo_id' => '7']);
        Diagnostico::create([ 'diagnostico' => 'TUMORES','consulta_motivo_id' => '7']);
        Diagnostico::create([ 'diagnostico' => 'CIRUGIA','consulta_motivo_id' => '7']);
        Diagnostico::create([ 'diagnostico' => 'OTROS','consulta_motivo_id' => '7']);
        Diagnostico::create([ 'diagnostico' => 'ALTERACION MENSTRUAL' ,'consulta_motivo_id' => '8']);
        Diagnostico::create([ 'diagnostico' => 'DIABETES' ,'consulta_motivo_id' => '8']);
        Diagnostico::create([ 'diagnostico' => 'HIPOTIROIDISMO' ,'consulta_motivo_id' => '8']);
        Diagnostico::create([ 'diagnostico' => 'TUMORES' ,'consulta_motivo_id' => '8']);
        Diagnostico::create([ 'diagnostico' => 'CIRUGIA' ,'consulta_motivo_id' => '8']);
        Diagnostico::create([ 'diagnostico' => 'OTROS' ,'consulta_motivo_id' => '8']);
        Diagnostico::create([ 'diagnostico' => 'CEFALEA' ,'consulta_motivo_id' => '9']);
        Diagnostico::create([ 'diagnostico' => 'TOMA DE TA' ,'consulta_motivo_id' => '9']);
        Diagnostico::create([ 'diagnostico' => 'OTITIS' ,'consulta_motivo_id' => '9']);
        Diagnostico::create([ 'diagnostico' => 'TOS' ,'consulta_motivo_id' => '9']);
        Diagnostico::create([ 'diagnostico' => 'FIEBRE' ,'consulta_motivo_id' => '9']);
        Diagnostico::create([ 'diagnostico' => 'CATARRO'  ,'consulta_motivo_id' => '9']);
        Diagnostico::create([ 'diagnostico' => 'ANSIEDAD' ,'consulta_motivo_id' => '10']);
        Diagnostico::create([ 'diagnostico' => 'DEPRESION' ,'consulta_motivo_id' => '10']);
        Diagnostico::create([ 'diagnostico' => 'PSICOSIS' ,'consulta_motivo_id' => '10']);
        Diagnostico::create([ 'diagnostico' => 'CONFUSION' ,'consulta_motivo_id' => '10']);
        Diagnostico::create([ 'diagnostico' => 'DETERIORO COGNITIVO' ,'consulta_motivo_id' => '10']);
        Diagnostico::create([ 'diagnostico' => 'EPILEPSIA' ,'consulta_motivo_id' => '10']);
        Diagnostico::create([ 'diagnostico' => 'OTROS' ,'consulta_motivo_id' => '10']);
        Diagnostico::create([ 'diagnostico' => 'ADICCIONES' ,'consulta_motivo_id' => '10']);
        Diagnostico::create([ 'diagnostico' => 'EXODONCIA' ,'consulta_motivo_id' => '11']);
        Diagnostico::create([ 'diagnostico' => 'INFECCION' ,'consulta_motivo_id' => '11']);
        Diagnostico::create([ 'diagnostico' => 'TUMORES' ,'consulta_motivo_id' => '11']);
        Diagnostico::create([ 'diagnostico' => 'CIRUGIA' ,'consulta_motivo_id' => '11']);
        Diagnostico::create([ 'diagnostico' => 'OTROS' ,'consulta_motivo_id' => '11']);
        Diagnostico::create([ 'diagnostico' => 'ODONTALGIA' ,'consulta_motivo_id' => '11']);
        Diagnostico::create([ 'diagnostico' => 'CONJUNTIVITIS' ,'consulta_motivo_id' => '12']);
        Diagnostico::create([ 'diagnostico' => 'QUERATITIS' ,'consulta_motivo_id' => '12']);
        Diagnostico::create([ 'diagnostico' => 'BLEFARITIS' ,'consulta_motivo_id' => '12']);
        Diagnostico::create([ 'diagnostico' => 'RETINOPATIA' ,'consulta_motivo_id' => '12']);
        Diagnostico::create([ 'diagnostico' => 'TUMORES' ,'consulta_motivo_id' => '12']);;
        Diagnostico::create([ 'diagnostico' => 'CIRUGIA' ,'consulta_motivo_id' => '12']);
        Diagnostico::create([ 'diagnostico' => 'OTROS' ,'consulta_motivo_id' => '12']);
        Diagnostico::create([ 'diagnostico' => 'MACULAS' ,'consulta_motivo_id' => '13']);
        Diagnostico::create([ 'diagnostico' => 'URTICARIA / PRURITO' ,'consulta_motivo_id' => '13']);
        Diagnostico::create([ 'diagnostico' => 'INFECCION' ,'consulta_motivo_id' => '13']);
        Diagnostico::create([ 'diagnostico' => 'TUMORES' ,'consulta_motivo_id' => '13']);
        Diagnostico::create([ 'diagnostico' => 'CIRUGIA' ,'consulta_motivo_id' => '13']);
        Diagnostico::create([ 'diagnostico' => 'OTROS' ,'consulta_motivo_id' => '13']);
        Diagnostico::create([ 'diagnostico' => 'COLAGENOPATIAS' ,'consulta_motivo_id' => '14']);
        Diagnostico::create([ 'diagnostico' => 'ANEMIA','consulta_motivo_id' => '14']);
        Diagnostico::create([ 'diagnostico' => 'EMBARAZO NORMAL','consulta_motivo_id' => '14']);
        Diagnostico::create([ 'diagnostico' => 'EMBARAZO PATOLOGICO','consulta_motivo_id' => '14']);


        }
        }
