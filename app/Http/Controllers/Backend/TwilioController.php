<?php

namespace App\Http\Controllers\Backend;

use App\Models\Event;
use App\Models\Trabajador;

use Carbon\Carbon;
use App\Http\Controllers\Controller;

require_once '/var/www/html/resources/views/backend/twilio/vendor/twilio/sdk/Twilio/autoload.php';

use Twilio\Rest\Client;
use App\Twilio;

use Illuminate\Http\Request;

class TwilioController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function recordatorio_sms()
    {
        // Your Account SID and Auth Token from twilio.com/console
        // Your Account SID and Auth Token from twilio.com/console
        $account_sid = 'AC71e699bf67036d4a481e7d4eac3324e5';
        $auth_token = '33dbfb6d7acb656ac3261a122d4eb398';
        // In production, these should be environment variables. E.g.:
        // $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

        // A Twilio number you own with SMS capabilities
        $twilio_number = "+18638672027";


        $cita_sms = Event::whereDate('start_date', '=', \Carbon\Carbon::tomorrow()->format('Y-m-d'))->get();

        if ($cita_sms->count() > 0) {
            foreach ($cita_sms as $row) {


                $trabajador = $row->trabajador->nombre . " " . $row->trabajador->apellido;
                $telefono = $row->trabajador->celular;
                $empresa = $row->trabajador->empresa->nombre;
                $fecha = date_format(date_create($row->start_date), "d/m/Y");
                $hora = date_format(date_create($row->start_time), "h:i");


                $client = new Client($account_sid, $auth_token);
                $client->messages->create(
                // Where to send a text message (your cell phone?)
                    '+34623181389',
                    array(
                        'from' => $twilio_number,
                        'body' => 'Buenos días ' . $trabajador . '. No olvide que tiene una cita con el Servicio Médico de ' . $row->trabajador->empresa->nombre . ' mañana ' . $fecha . ' a las ' . $hora . ' en ' . $row->trabajador->empresa->direccion . '.'
                    )
                );

                print "Enviado mensaje a " . $trabajador . " de la empresa " . $empresa;
                print "<br>";

            }
        } else {
            print "No hay programada ninguna cita para el día de mañana";
        }
    }
}
