<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ValidateAbleTrait;

class CitaApiController extends Controller
{
    use ValidateAbleTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->runValidator($request->all(), [
            'cita.description' => 'required',
            'cita.start_date' => 'required',
            'trabajador_id' => 'required'
        ], []);

        //prepare share with data
        $share_with = $request->post('share_with');
        if ($share_with == "specific") {
            $share_with = $request->post('share_with_specific');
        } else if ($share_with == "specific_client_contacts") {
            $share_with = $request->post('share_with_specific_client_contact');
        } else {
            $share_with = "cita";
        }

        if ( $request->has('fecha_cita') or $request->has('end_time') ) {
            $start_time = Carbon::now();
            $end_time = Carbon::now();
        }

        $data = array(
            "description" => $request->input('cita.description'),
            "start_date" => Carbon::parse($request->post('cita.start_date'))->format('Y-m-d'),
            "end_date" =>  Carbon::parse($request->post('cita.start_date'))->format('Y-m-d'),
            "start_time" =>  Carbon::parse($request->post('fecha_cita'))->format('h:i:s') ,
            "user_id" => auth()->user()->id,
            "color" => "#29c2c2",
            "trabajador_id" => $request->post('trabajador_id'),
            "empresa_id" => $request->post('empresa_id'),
            "share_with" => $share_with,
            "repeat_type" => NULL,
            "no_of_cycles" => 0
        );
        if (Event::whereDay('start_date', Carbon::parse($request->post('cita.start_date'))->format('d'))->whereTime('start_time', Carbon::parse($request->post('fecha_cita'))->format('h:i:s'))->exists()) {
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
