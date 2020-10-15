<?php

namespace App\Http\Controllers\Empresa;

use App\Mail\NewTicket;

use App\Models\Ticket;
use App\Models\Empresa;
use App\Models\Trabajador;


use App\Traits\CheckEmpresaTrait;

use App\User;

use Caffeinated\Shinobi\Models\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

use Spatie\Activitylog\Models\Activity;

use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\TicketEmpresaResource;

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
            'roles' => 'required|array',
            'motivo' => 'required|string'
        );
        
        $validator = $this->validate($request,$rules);
        $this->checkEmpresa($request->input('empresa_id'));
        $empresa = Empresa::findOrFail($request->input('empresa_id'));

        DB::beginTransaction();

        try {
            $ticket = $empresa->ticket()->create($request->except('roles'));

            

            $ticket->assignRole(auth()->user()->getRole());
            $user = auth()->user();
            $users = '';


            foreach ($request->input('roles') as $key => $role) {
                $ticket->assignRole($role['id']);
                $slug_role = Role::findOrFail($role['id']);
                $users = User::whereHas(
                    'roles', function($q) use ($slug_role){
                        $q->where('slug', $slug_role->slug);
                    }
                )->get();
            }
            
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
        $url = route('empresa.ticket.comentario.view', ['id' => $ticket->id, 'id_empresa' => $empresa->id]);

    
        Mail::to($user->email)->send(new NewTicket($url, $user));
        DB::commit();

        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'fail' => false,
                'text' => 'El ticket fue creado exitosamente..!',
                'redirect_url' => route('empresa.ticket-empresa.index', ['id' => $empresa->id, 'name' => $empresa->nombre] )
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'empresa_id' => 'required',
            'roles' => 'required|array',
            'motivo' => 'required|string'
        );

        $validator = $this->validate($request,$rules);
        $this->checkEmpresa($request->input('empresa_id'));
        $empresa = Empresa::find($request->input('empresa_id'));
        $ticket = Ticket::findOrFail($id);

        DB::beginTransaction();

        try {
            $ticket->fill($request->except('roles'))->update();

            $ticket->assignRole(auth()->user()->getRole());
            $user = auth()->user();
            $users = '';

            foreach ($request->input('roles') as $key => $role) {
                $ticket->assignRole($role['id']);
                $slug_role = Role::findOrFail($role['id']);
                $users = User::whereHas(
                    'roles', function($q) use ($slug_role){
                        $q->where('slug', $slug_role->slug);
                    }
                )->get();
            }
            
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
        $url = route('empresa.ticket.comentario.view', ['id' => $ticket->id, 'id_empresa' => $empresa->id]);

    
        Mail::to($user->email)->send(new NewTicket($url, $user));
        DB::commit();

        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'fail' => false,
                'text' => 'El ticket fue creado exitosamente..!',
                'redirect_url' => route('empresa.ticket-empresa.index', ['id' => $empresa->id, 'name' => $empresa->nombre] )
            ]);
        }


    }

    public function getTicketsJson($empresa_id)
    {
      $this->checkEmpresa($empresa_id);

      /*$tickets = DB::table('tickets')
            ->rightJoin('role_ticket', 'role_ticket.ticket_id', '=','tickets.id')
            ->leftJoin('users as creator', 'creator.id', '=', 'tickets.user_id')
            ->leftJoin('users as accion', 'accion.id', '=', 'tickets.accion_user_id')
            ->leftJoin('roles', 'roles.id', '=', 'role_ticket.role_id')
            ->leftJoin('empresas', 'empresas.id', '=', 'tickets.empresa_id')
            ->LeftJoin('ticket_comentarios', function ($join) {
                $join->on('ticket_comentarios.ticket_id', '=', 'tickets.id')->whereRaw('ticket_comentarios.id = (select max(`id`) from ticket_comentarios)');
            })
            ->select('tickets.motivo', 'tickets.status', 'creator.nombre', 'creator.apellido', 'ticket_comentarios.comentarios', 'empresas.nombre as empresa', 'accion.nombre as nombre_accion', 'accion.apellido as apellido_acction', 'roles.name as roles')
            ->where('role_ticket.role_id', '=', auth()->user()->getRole())
            ->groupBy('role_ticket.ticket_id')
            ->whereNull('tickets.deleted_at')
            ->where('tickets.empresa_id', $empresa_id)->paginate(10);*/
        $tickets = Ticket::with(['roles', 'user', 'empresa', 'accion_user', 'comentario' => function($query){
                            $query->whereRaw('id = (select max(`id`) from ticket_comentarios)');
                        }]) 
                        ->where('empresa_id', $empresa_id)
                        ->paginate(10);
            
      return TicketEmpresaResource::collection($tickets);
    }

    public function getRolesJson()
    {
        return response()->json(['roles' => Role::where('slug', '!=', 'admin')->where('slug', '!=', 'no-access')->get()]);
    }

    public function destroy($id)
    {
      $ticket = Ticket::findOrFail($id);

      if ($ticket->delete($id)) {
          return response()->json(['success' => true, 'message' => 'Registro eliminado']);
      } else {
          return response()->json(['success' => false, 'message' => 'Intente nuevamente']);
      }
    }
}
