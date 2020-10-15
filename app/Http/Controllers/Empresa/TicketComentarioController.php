<?php

namespace App\Http\Controllers\Empresa;



use App\Models\Ticket;
use App\Models\Empresa;
use App\Models\Trabajador;
use App\Models\TicketComentario;

use App\Traits\CheckRoleTicket;
use App\Traits\CheckEmpresaTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManagerStatic as Image;
use \DomDocument;

use Spatie\Activitylog\Models\Activity;

class TicketComentarioController extends Controller
{
    use CheckRoleTicket, CheckEmpresaTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $message = $request->comment;
        $summernote = new TicketComentario;
        $summernote->ticket_id = $request->ticket_id;
        $summernote->user_id = auth()->user()->id;
        $summernote->comentarios = $message;
        $summernote->save();

        return response()->json($summernote->fresh(['user']));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $empresa_id)
    {

        $empresa = Empresa::findOrFail($empresa_id);
        $ticket = Ticket::findOrFail($id);
        $this->isRoleTicket($ticket->id); // Supervisamos quien puede o no entrar a los tickets

        return view('tickets.comment.show_empresa', compact('empresa',  'ticket'));
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
        $ticket = Ticket::findOrFail($id);

        $ticket->status = false;
        $ticket->save();

        return response()->json($ticket);
    }


    public function openTicket(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->status = true;
        $ticket->save();

        return response()->json($ticket);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(Request $request, $id)
     {
         $this->checkEmpresa($request->input('empresa_id'));
         $ticket = Ticket::findOrFail($id);



         if( $ticket->delete() ) {
             $response = [
                 'id'        =>  $ticket->id,
                 'status'    =>  'success',
                 'message'   =>  'Registro eliminado',
             ];
         } else {
             $response = [
                 'status'    =>  'error',
                 'message'   =>  'Intente nuevamente'
             ];
         }

         if( \request()->ajax() ) {
             return new JsonResponse($response);
         } else {

         }
     }

    public function getUploadFiles(Request $request)
    {
        $extension = $request->file('file')->getClientOriginalExtension();
        $fileName = uniqid() . '.' . $extension;
        $destination = public_path() . '/img';

        $request->file('file')->move($destination, $fileName);
        return  url('img/'. $fileName);
    }

    public function getComments(Request $request, $id)
    {
        if ($request->ajax()){
          $comments = TicketComentario::where('ticket_id', $id)
          ->with(['user'])
                   ->get();

           return view('trabajador.ticket.comment.commentlist', compact('comments'));
       }
    }
}
