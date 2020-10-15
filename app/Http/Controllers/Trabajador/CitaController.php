<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 1/21/2019
 * Time: 9:41 a.m.
 */

namespace App\Http\Controllers\Trabajador;


use App\Http\Controllers\Controller;
use App\Models\Event;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CitaController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'start_date' => 'required',
            'trabajador_id' => 'required'
        ]);

        //prepare share with data
        $share_with = $request->post('share_with');
        if ($share_with == "specific") {
            $share_with = $request->post('share_with_specific');
        } else if ($share_with == "specific_client_contacts") {
            $share_with = $request->post('share_with_specific_client_contact');
        } else {
            $share_with = "cita";
        }

        if ( $request->has('start_time') or $request->has('end_time') ) {
            $start_time = Carbon::now();
            $end_time = Carbon::now();
        }

        $data = array(
            "description" => $request->post('description'),
            "start_date" => $request->post('start_date'),
            "end_date" => $request->post('start_date'),
            "start_time" => $request->post('start_time'),
            "user_id" => auth()->user()->id,
            "color" => "#29c2c2",
            "trabajador_id" => $request->post('trabajador_id'),
            "empresa_id" => $request->post('empresa_id'),
            "share_with" => $share_with,
            "repeat_type" => NULL,
            "no_of_cycles" => 0
        );

        if (Event::whereDay('start_date', Carbon::parse($request->post('start_date'))->format('d'))->whereTime('start_time', Carbon::parse($request->post('start_time'))->format('h:i:s'))->exists()) {
              return response()->json([
                'fail' => true,
                'text' => 'Ya hay cita programada para esa fecha y hora elija otro dia y hora.',
                'redirect_url' => redirect()->back()
              ], 401);
        } else {
          if ($event = Event::create($data)){
            return response()->json([
                'fail' => false,
                'text' => 'La cita fue creada exitosamente..!',
                'redirect_url' => route('trabajador.cita.pdf', ['id' => Crypt::encrypt($event->id)]) // Redirect open pdf :)
            ]);
          } else {

          }
        }
       

    }

    /**
     * @param $id
     * @return mixed
     */
    public function getGeneratePdfCita($id)
    {
        $encrypted_event_id =  Crypt::decrypt($id);

        $event = Event::with(['user', 'trabajador', 'empresa'])->findOrFail($encrypted_event_id);

        $pdf = PDF::loadView('views_pdf.cita', compact('event'));

        return $pdf->stream('listado.pdf');
    }
}