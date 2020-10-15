<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Calendar;
use App\Event;
class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = [];

      $data = Event::all();

      if($data->count()){

         foreach ($data as $key => $value) {

           $events[] = Calendar::event(

               $value->title,

               true,

               new \DateTime($value->start_date),

               new \DateTime($value->end_date.' +1 day')

           );

         }

      }

      $calendar = Calendar::addEvents($events);

        return view('backend.calendario.index', compact('calendar'));
    }
}
