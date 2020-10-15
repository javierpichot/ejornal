<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 17/01/19
 * Time: 07:39 PM
 */

namespace App\Http\Controllers;


use App\Models\TicketComentarioJornal;
use App\Models\TicketsJornal;
use App\Traits\CheckRoleTicketJornal;
use App\User;
use Illuminate\Http\Request;

/**
 * Class TicketComentarioJornalsController
 * @package App\Http\Controllers
 */
class TicketComentarioJornalsController extends Controller
{
    use CheckRoleTicketJornal;

    /**
     * TicketComentarioJornalsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $ticket = TicketsJornal::findOrFail($request->tickets_jornal_id);
        $message = $request->comment;
        $summernote = new TicketComentarioJornal();
        $summernote->tickets_jornal_id = $request->tickets_jornal_id;
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

        return response()->json($summernote->fresh(['user']));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $ticket = TicketsJornal::findOrFail($id);
        $this->isRoleTicket($ticket->id); // Supervisamos quien puede o no entrar a los tickets
        return view('tickets_jornals.comments.show', compact('ticket'));
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
        $ticket = TicketsJornal::findOrFail($id);
        $ticket->status = false;
        $ticket->save();
        return response()->json($ticket);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function openTicket(Request $request, $id)
    {
        $ticket = TicketsJornal::findOrFail($id);

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
    public function destroy($id)
    {
        //
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
            $comments = TicketComentarioJornal::where('ticket_id', $id)
                ->with(['user'])
                ->get();

            return view('tickets_jornals.comments.commentlist', compact('comments'));
        }
    }
}