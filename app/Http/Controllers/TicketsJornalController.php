<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 17/01/19
 * Time: 03:25 PM
 */

namespace App\Http\Controllers;


use App\Models\TicketsJornal;
use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class TicketsJornalController
 * @package App\Http\Controllers
 */
class TicketsJornalController extends Controller
{
    /**
     * TicketsJornalController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTickets()
    {

        $tickets = DB::table('tickets_jornals')
            ->leftJoin('role_tickets_jornal', 'role_tickets_jornal.tickets_jornal_id', '=','tickets_jornals.id')
            ->leftJoin('users as creator', 'creator.id', '=', 'tickets_jornals.user_id')
            ->leftJoin('users as accion', 'accion.id', '=', 'tickets_jornals.accion_user_id')
            ->LeftJoin('ticket_comentario_jornals', function ($join) {
                $join->on('ticket_comentario_jornals.tickets_jornal_id', '=', 'tickets_jornals.id')->whereRaw('ticket_comentario_jornals.id = (select max(`id`) from ticket_comentario_jornals)');
            })
            ->select('tickets_jornals.*', 'creator.nombre', 'creator.apellido', 'ticket_comentario_jornals.comentarios', 'accion.nombre as nombre_accion', 'accion.apellido as apellido_acction')
            ->where('role_tickets_jornal.role_id', '=', auth()->user()->getRole())

            //  ->whereRaw('ticket_comentarios.id = (select max(`id`) from ticket_comentarios)')
            ->groupBy('role_tickets_jornal.tickets_jornal_id')
            ->whereNull('tickets_jornals.deleted_at')
            ->where('tickets_jornals.user_id', auth()->user()->id)->get();

        $roles = Role::get();


        return view('tickets_jornals.index', compact('roles', 'tickets'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editTicketEmpresa($id)
    {
        $ticket = TicketsJornal::with(['user', 'roles'])->findOrFAil($id);
        $roles = Role::where('slug', '!=', 'admin')->get();
        return view('tickets_jornals.includes.form', compact('ticket', 'roles'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function updateTicketEmpresa(Request $request, $id)
    {
        $ticket = TicketsJornal::find($id);
        $ticket->motivo = $request->input('motivo');
        $ticket->observacion = $request->input('observacion');
        $ticket->save();

        $ticket->syncRoles($request->input('roles'));


        if ($request->ajax()){
            return response()->json([
                'fail' => false,
                'text' => 'La ticket fue creado exitosamente..!',
                'redirect_url' => route('ticket-jornals.index')
            ]);
        } else {

            return redirect()->route('ticket-jornals.index');
        }


    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $rules = array(
            'user_id' => 'required',
            'roles' => 'required|array',
            'motivo' => 'required|string'
        );
        // CHECK FORM VALIDATION
        $validator = $this->validate($request,$rules);
        $user = User::findOrFail(Auth::user()->id);


        $ticket = $user->ticket_jornal()->create($request->except('_token'));

        $ticket->syncRoles($request->input('roles'));

        $ticket->assignRole(auth()->user()->getRole());

        $users = '';

        foreach ($request->input('roles') as $key => $role) {
            $slug_role = Role::findOrFail($role);
            $users = User::whereHas(
                'roles', function($q) use ($slug_role){
                $q->where('slug', $slug_role->slug);
            }
            )->get();
        }

        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'fail' => false,
                'text' => 'El ticket fue creado exitosamente..!',
                'redirect_url' => route('ticket-jornals.index')
            ]);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $ticket = TicketsJornal::findOrFail($id);

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