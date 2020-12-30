<?php

namespace App\Http\Controllers\Empresa;

use App\Models\Tarea;
use App\Models\Turno;
use App\Models\Sector;
use App\Models\Ticket;
use App\Models\Empresa;
use App\Models\Localidad;
use App\Models\Enfermedad;
use App\Models\ObraSocial;
use App\Models\Trabajador;
use App\Models\Ausentismo;

use App\User;

use App\Traits\CheckEmpresaTrait;

use Caffeinated\Shinobi\Models\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Spatie\Activitylog\Models\Activity;

use Yajra\DataTables\DataTables;

/**
 * Class EmpresaController
 * @package App\Http\Controllers\Empresa
 */
class EmpresaController extends Controller
{
    use CheckEmpresaTrait;

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $this->checkEmpresa($id);
      $total_trabajadores = Trabajador::where('empresa_id', $id)->count();
      $total_usuarios = DB::table('empresa_user')->where('empresa_id', $id)->count();
      $total_consultas = DB::table('consultas')->where('empresa_id', $id)->whereDate('created_at', '=', \Carbon\Carbon::now()->format('Y-m-d'))->count();

      $total_ausentismo_abiertos = Ausentismo::where('empresa_id', $id)->WhereNull('fecha_alta')->count();

        $empresa = Empresa::with(['ticket.trabajador', 'ticket.user', 'ticket.comentario' => function ($query)
        {
            $query->whereRaw('id = (select max(`id`) from ticket_comentarios)'); //Filtramo el utlimo comentario en el ticket
        }, 'ticket.roles'])->findOrFAil($id);




        return view('empresa.profile.show', compact('empresa','total_trabajadores','total_usuarios','total_ausentismo_abiertos','total_consultas'));
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTicketEmpresa($id)
    {
        $this->checkEmpresa($id);


        $empresa = Empresa::findOrFAil($id);
        $tickets = DB::table('tickets')
            ->rightJoin('role_ticket', 'role_ticket.ticket_id', '=','tickets.id')
            ->leftJoin('users as creator', 'creator.id', '=', 'tickets.user_id')
            ->leftJoin('users as accion', 'accion.id', '=', 'tickets.accion_user_id')
            ->leftJoin('empresas', 'empresas.id', '=', 'tickets.empresa_id')
            ->LeftJoin('ticket_comentarios', function ($join) {
                $join->on('ticket_comentarios.ticket_id', '=', 'tickets.id')->whereRaw('ticket_comentarios.id = (select max(`id`) from ticket_comentarios)');
            })
            ->select('tickets.*', 'creator.nombre', 'creator.apellido', 'ticket_comentarios.comentarios', 'empresas.nombre as empresa', 'accion.nombre as nombre_accion', 'accion.apellido as apellido_acction')
            ->where('role_ticket.role_id', '=', auth()->user()->getRole())
            ->groupBy('role_ticket.ticket_id')
            ->whereNull('tickets.deleted_at')
            ->where('tickets.empresa_id', $id)->get();



        $roles = Role::where('slug', '!=', 'admin')->get();
        return view('tickets.index', compact('tickets', 'roles', 'empresa'));

    }

    /**
     * @param $id
     * @param $id_empresa
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editTicketEmpresa($id, $id_empresa, Request $request)
    {
        $this->checkEmpresa($id_empresa);

        $ticket = Ticket::with(['trabajador', 'user', 'roles'])->findOrFAil($id);
        $roles = Role::where('slug', '!=', 'admin')->get();

        return view('empresa.ticket.edit', compact('ticket', 'roles'));
    }

    /**
     * @param Request $request
     * @param $id
     * @param $id_empresa
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateTicketEmpresa(Request $request, $id, $id_empresa)
    {
        $this->checkEmpresa($id_empresa);
        $empresa = Empresa::findOrFail($id_empresa);
        $ticket = Ticket::find($id);
        $ticket->motivo = $request->input('motivo');
        $ticket->observacion = $request->input('observacion');
        $ticket->save();


        $ticket->syncRoles($request->input('roles'));
        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'text' => 'Ticket actualizado exitosamente..!',
                'fail' => false,
                'redirect_url' => route('empresa.show', ['id' => $id_empresa, 'name' => $empresa->nombre] )
            ]);
        }
    }

    /**
     * @param $id_empresa
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTrabajadores($id_empresa)
    {
        $this->checkEmpresa($id_empresa);
        $empresa = Empresa::findOrFail($id_empresa);
        $obra_social = ObraSocial::get();
        $localidades = Localidad::get();
        $sectores = Sector::where('empresa_id', $id_empresa)->get();
        $tareas = Tarea::where('empresa_id', $id_empresa)->get();
        $turnos = Turno::where('empresa_id', $id_empresa)->get();
        $enfermedades = Enfermedad::get();
        $filter_enfermedades = collect($enfermedades);

        $antecedentes_medico = $filter_enfermedades->filter(function ($value, $key) {
            return $value->tipo == 1;
        });

        $antecedentes_familiar = $filter_enfermedades->filter(function ($value, $key) {
            return $value->tipo == 3;
        });

        $estilo_vida = $filter_enfermedades->filter(function ($value, $key) {
            return $value->tipo == 2;
        });
        return view('empresa.trabajador.index', compact('obra_social', 'localidades', 'sectores', 'tareas', 'turnos', 'antecedentes_medico', 'antecedentes_familiar', 'estilo_vida', 'empresa'));
    }

    /**
     * @param $empresa_id
     * @param $trabajador
     * @return string
     */
    protected function getFotoTrabajador($empresa_id, $trabajador)
    {
        return isset($trabajador->photo) ?  asset('storage/empresas/'. $empresa_id . '/trabajadores/' . $trabajador->id . '/perfil/'. $trabajador->photo . '') : asset('img/avatar5.png');
    }

    /**
     * @param $id_empresa
     * @return mixed
     * @throws \Exception
     */
    public function getTrabajadoresEmpresa($id_empresa)
    {
        $this->checkEmpresa($id_empresa);
        $trabajador = Trabajador::with(['sector', 'localidad', 'obra_social', 'tarea', 'turno'])->where('empresa_id', $id_empresa)->get();

        return DataTables::of($trabajador)
            ->addColumn('foto', function ($trabajador) use ($id_empresa) {
                return '<a href="'.route('trabajador.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $id_empresa]).'"><img src="'.
                $this->getFotoTrabajador($id_empresa, $trabajador)
                .'" class="img-circle elevation-2" width="55px"></a>';
            })
            ->addColumn('nombre', function ($trabajador) use ($id_empresa) {
                return $trabajador->apellido .", ". $trabajador->nombre;
            })
            ->addColumn('action', function ($trabajador) use ($id_empresa) {
                return '<button class="btn btn-warning" title="Edit" href="#modalForm" 		data-toggle="modal" data-href="' . route('empresa.trabajadores.edit', ['id' => $trabajador->id, 'id_empresa' => $id_empresa ]) .
                '"><i title="Editar ticket" class="fa fa-pencil"></i></button>
                <form method="post" id="confirm_delete" class="pull-right">'.
                  method_field('DELETE') .'

                    <input type="hidden" name="_token" value="'. csrf_token() .'">
                    <input type="hidden" name="empresa_id" value="'.$id_empresa  .'">
                    <button type="button" class="btn btn-danger delete-confirm" data-id="' .$trabajador->id . '" data-href="'. route('empresa.trabajadores.destroy', ['id' => $trabajador->id]) .'">
                      <i class="fa fa-trash"></i>
                    </button>
                </form>

                ';
            })
            ->make(true);
    }
}
