<?php

namespace App\Http\Controllers\Trabajador;



use App\Mail\NewCommentTicket;

use App\Models\Ticket;
use App\Models\Empresa;
use App\Models\Trabajador;
use App\Models\TicketComentario;

use Illuminate\Support\Facades\Mail;
use App\Traits\CheckRoleTicket;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManagerStatic as Image;
use \DomDocument;

use Spatie\Activitylog\Models\Activity;

/**
 * Class TicketComentarioController
 * @package App\Http\Controllers\Trabajador
 */
class TicketComentarioController extends Controller
{
    use CheckRoleTicket;
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ticket = Ticket::findOrFail($request->ticket_id);
        $message = $request->comment;
        $summernote = new TicketComentario;
        $summernote->ticket_id = $request->ticket_id;
        $summernote->user_id = auth()->user()->id;
        $summernote->comentarios = $message;
        $summernote->save();

        $users = '';

        foreach ($ticket->roles()->get() as $key => $role) {

            $users = User::whereHas(
                'roles', function($q) use ($role){
                    $q->where('slug', $role->slug);
                }
            )->get();
        }

        $trabajador_id = $ticket->trabajador_id."#comment_".$summernote->id;

        $url = route('trabajador.ticket.comentario.view', ['id' => $request->ticket_id, 'id_empresa' => $ticket->empresa_id, 'trabajador_id' => $trabajador_id]);


        foreach ($users as $key => $user) {
            Mail::to($user->email)->send(new NewCommentTicket($url, $user));
        }



        return response()->json($summernote->fresh(['user']));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $empresa_id, $trabajador_id)
    {

        $empresa = Empresa::findOrFail($empresa_id);
        $trabajador = Trabajador::findOrFail($trabajador_id);
        $ticket = Ticket::findOrFail($id);
        $this->isRoleTicket($ticket->id); // Supervisamos quien puede o no entrar a los tickets

        return view('tickets.comment.show', compact('empresa', 'trabajador', 'ticket'));
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

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getUploadFiles(Request $request)
    {
        $extension = $request->file('file')->getClientOriginalExtension();
        $fileName = uniqid() . '.' . $extension;
        $destination = public_path() . '/img';

        $request->file('file')->move($destination, $fileName);
        return  url('img/'. $fileName);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
