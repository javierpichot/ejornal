<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DetalleCitaController extends Controller
{
    protected $model;

    public function __construct(Event $event)
    {
        $this->model = $event;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = Crypt::decrypt($request->post('id'));
        $model_info = $this->model->with(['trabajador'])
            ->findOrFail($id);

        if ($model_info->id && $id) {
            $view_data['encrypted_event_id'] = Crypt::encrypt($id); //to make is secure we'll use the encrypted id
            $view_data['model_info'] = $model_info;
            return view('events.ausencia_details', compact('view_data'));
        }
    }
}
