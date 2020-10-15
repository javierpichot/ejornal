<?php

namespace App\Http\Controllers\Trabajador;


use App\Http\Controllers\Controller;

use App\Mail\NewTicket;

use App\Models\Ticket;
use App\Models\Empresa;
use App\Models\Trabajador;


use App\Traits\CheckEmpresaTrait;

use App\User;

use Caffeinated\Shinobi\Models\Role;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;

use Spatie\Activitylog\Models\Activity;

/**
 * Class TicketController
 * @package App\Http\Controllers\Trabajador
 */
class TicketController extends Controller
{
    use CheckEmpresaTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'empresa_id' => 'required',
            'trabajador_id' => 'required',
            'roles' => 'required|array',
            'motivo' => 'required|string'
        );

        $users = '';

        foreach ($request->input('roles') as $key => $role) {
            $slug_role = Role::findOrFail($role);
            $users = User::whereHas(
                'roles', function($q) use ($slug_role){
                    $q->where('slug', $slug_role->slug);
                }
            )->get();
        }

        // CHECK FORM VALIDATION
        $validator = $this->validate($request,$rules);

        $this->checkEmpresa($request->input('empresa_id'));
        $empresa = Empresa::findOrFail($request->input('empresa_id'));
        $trabajador = Trabajador::findOrFail($request->input('trabajador_id'));
        $ticket = Ticket::create($request->except('_token'));

        $ticket->syncRoles($request->input('roles'));
        $ticket->assignRole(auth()->user()->getRole());

        $url = route('trabajador.ticket.comentario.view', ['id' => $ticket->id, 'id_empresa' => $empresa->id, 'trabajador_id' => $trabajador->id]);

        foreach ($users as $key => $user) {
            Mail::to($user->email)->send(new NewTicket($url, $user));
        }

        if ($request->ajax()){
            return response()->json([
                'fail' => false,
                'text' => 'La ticket fue creado exitosamente..!',
                'redirect_url' => route('trabajador.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id] )
            ]);
        } else {

            return redirect()->route('trabajador.ticket.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id] );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show($id, $name, $empresa_id)
    {

      $this->checkEmpresa($empresa_id);
      $empresa = Empresa::findOrFail($empresa_id);
      $trabajador = Trabajador::findOrFail($id);

        $tickets = DB::table('tickets')
            ->leftJoin('role_ticket', 'role_ticket.ticket_id', '=','tickets.id')
            ->leftJoin('users as creator', 'creator.id', '=', 'tickets.user_id')
            ->leftJoin('users as accion', 'accion.id', '=', 'tickets.accion_user_id')
            ->leftJoin('empresas', 'empresas.id', '=', 'tickets.empresa_id')
            ->leftJoin('trabajadors', 'trabajadors.id', '=', 'tickets.trabajador_id')
            ->LeftJoin('ticket_comentarios', function ($join) {
                $join->on('ticket_comentarios.ticket_id', '=', 'tickets.id')->whereRaw('ticket_comentarios.id = (select max(`id`) from ticket_comentarios)');
            })
            ->select('tickets.*', 'creator.nombre', 'creator.apellido', 'ticket_comentarios.comentarios', 'empresas.nombre as empresa', 'accion.nombre as nombre_accion', 'accion.apellido as apellido_acction', 'trabajadors.nombre as trabajador_nombre', 'trabajadors.apellido as trabajador_apellido', 'trabajadors.id as trabajador_id')
            ->where('role_ticket.role_id', '=', auth()->user()->getRole())

            //  ->whereRaw('ticket_comentarios.id = (select max(`id`) from ticket_comentarios)')
            ->groupBy('role_ticket.ticket_id')
            ->whereNull('tickets.deleted_at')
            ->where('tickets.trabajador_id', $id)->get();
        $roles = Role::get();
        return view('trabajador.ticket.index', compact('trabajador', 'empresa', 'roles', 'tickets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id, $empresa_id)
    {
        $this->checkEmpresa($empresa_id);
        $ticket = Ticket::with(['trabajador', 'user', 'roles'])->findOrFAil($id);
        $roles = Role::where('slug', '!=', 'admin')->get();
        return view('trabajador.ticket._form', compact('ticket', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->checkEmpresa($request->input('empresa_id'));
        $empresa = Empresa::findOrFail($request->input('empresa_id'));
        $trabajador = Trabajador::find($request->input('trabajador_id'));
        $ticket = Ticket::find($id);
        $ticket->motivo = $request->input('motivo');
        $ticket->observacion = $request->input('observacion');
        $ticket->save();

        $ticket->syncRoles($request->input('roles'));


        if ($request->ajax()){
            return response()->json([
                'fail' => false,
                'text' => 'La ticket fue creado exitosamente..!',
                'redirect_url' => route('trabajador.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id] )
            ]);
        } else {

            return redirect()->route('trabajador.ticket.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id] );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->checkEmpresa($request->input('empresa_id'));
        $trabajador = Trabajador::find($request->input('trabajador_id'));
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
}
