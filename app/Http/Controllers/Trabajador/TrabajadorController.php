<?php

namespace App\Http\Controllers\Trabajador;

use App\Models\Empresa;
use App\Models\Trabajador;
use App\Models\Ausentismo;
use App\Models\AusentismoTipo;
use App\Models\Incidencia;
use App\Models\Documentacion;
use App\Models\Consulta;
use App\Models\Ticket;
use App\Models\Remitente;
use App\Models\ConsultaMotivo;
use App\Models\ModoComunicacion;
use App\Models\MotivoComunicacion;


use App\Traits\CheckEmpresaTrait;

use Caffeinated\Shinobi\Models\Role;

use Carbon\Carbon;
use UrlSigner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class TrabajadorController
 * @package App\Http\Controllers\Trabajador
 */
class TrabajadorController extends Controller
{
    use CheckEmpresaTrait;
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $name, $empresa_id)
    {

      $this->checkEmpresa($empresa_id);
        $empresa = Empresa::findOrFail($empresa_id);

        $trabajador = Trabajador::with(['ticket.trabajador', 'ausentismo', 'ticket.user', 'ticket.accion_user', 'ticket.comentario', 'ticket.roles'])->findOrFail($id);
        $widget1= Ausentismo::where( 'trabajador_id', $id)-> where( 'fecha_ausente', '>', Carbon::now()->subDays(30))->get();
        $widget2= Ausentismo::where( 'trabajador_id', $id)-> where( 'fecha_ausente', '>', Carbon::now()->subDays(90))->get();
        $widget3= Ausentismo::where( 'trabajador_id', $id)-> where( 'fecha_ausente', '>', Carbon::now()->subDays(365))->get();
        $ausentismo_tipo = AusentismoTipo::all();
        $remitentes = Remitente::all();
        $consulta_motivos = ConsultaMotivo::all();
        $modo_comunicaciones = ModoComunicacion::all();
        $motivo_comunicaciones = MotivoComunicacion::all();
        $total_incidencias=Incidencia::where( 'trabajador_id', $id)->count();
        $total_documentacion=Documentacion::where( 'trabajador_id', $id)->count();
        $total_consultas=Consulta::where( 'trabajador_id', $id)->count();
        $total_ticket_abierto=Ticket::where( 'trabajador_id', $id)
        ->where( 'status', 1)->count();
        $total_episodio_ausentismo=Ausentismo::where( 'trabajador_id', $id)
        ->where( 'fecha_alta', null)->count();

        $roles = Role::get();

        return view('trabajador.profile.show', compact('ausentismo_tipo', 'consulta_motivos', 'modo_comunicaciones', 'motivo_comunicaciones', 'remitentes', 'trabajador', 'empresa','widget1','widget2', 'widget3','total_incidencias','total_documentacion','total_consultas','total_ticket_abierto','total_episodio_ausentismo','roles'));
    }



    public function edit($trabajador_id, $empresa_id)
    {
        $this->checkEmpresa($empresa_id);
        return response()->json(['data' => Trabajador::with(['antecedente_medico', 'antecedente_familiar', 'estilo_vida', 'familiar'])->findOrFail($trabajador_id)]);
    }

    /**
     * @param $empresa_id
     * @param $trabajador_id
     * @param $filename
     * @param $documento_id
     * @param $type_a
     * @param $type_b
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generateUrlPrestacion($empresa_id, $trabajador_id, $filename, $documento_id, $type_a, $type_b)
    {

            $this->checkEmpresa($empresa_id);

            $url = UrlSigner::sign(route('trabajador.documentacion.download',['trabajador_id' => $trabajador_id, 'filename' => $filename, 'empresa_id' => $empresa_id, 'documento_id' => $documento_id, 'type_a' => $type_a, 'type_b' => $type_b]), Carbon::now()->addSeconds(10));
            return redirect()->to($url);
    }

    /**
     * @param $trabajador_id
     * @param $empresa_id
     * @param $filename
     * @param $documento_id
     * @param $type_a
     * @param $type_b
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadUrlPrest($trabajador_id, $empresa_id, $filename, $documento_id, $type_a, $type_b)
    {
          return response()->download(storage_path("app/public/empresas/$empresa_id/trabajadores/$trabajador_id/$type_a/$documento_id/{$filename}"));
    }

    /**
     * @param $empresa_id
     * @param $trabajador_id
     * @param $filename
     * @param $documento_id
     * @param $type
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generateUrl($empresa_id, $trabajador_id, $filename, $documento_id, $type)
    {
        $this->checkEmpresa($empresa_id);

        $url = UrlSigner::sign(route('trabajador.documentacion.download',['trabajador_id' => $trabajador_id, 'filename' => $filename, 'empresa_id' => $empresa_id, 'documento_id' => $documento_id, 'type' => $type]), Carbon::now()->addSeconds(10));
        return redirect()->to($url);
    }


    /**
     * @param $trabajador_id
     * @param $empresa_id
     * @param $filename
     * @param $documento_id
     * @param $type
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($trabajador_id, $empresa_id, $filename, $documento_id, $type)
    {
          return response()->download(storage_path("app/public/empresas/$empresa_id/trabajadores/$trabajador_id/$type/$documento_id/{$filename}"));
    }
}
