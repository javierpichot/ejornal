<?php

namespace App\Http\Controllers\Trabajador;

use App\Models\Empresa;
use App\Models\Remitente;
use App\Models\Ausentismo;
use App\Models\Trabajador;
use App\Models\Comunicacion;
use App\Models\Documentacion;
use App\Models\ModoComunicacion;
use App\Models\MotivoComunicacion;

use App\Traits\CheckEmpresaTrait;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use Maatwebsite\Excel\Facades\Excel;

use Spatie\Activitylog\Models\Activity;
use App\Http\Resources\DocumentosTrabajadorResource;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

/**
 * Class ComunicacionController
 * @package App\Http\Controllers\Trabajador
 */
class ComunicacionController extends Controller
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
        $this->validate($request, [
            'trabajador_id' => 'required',
            'empresa_id' => 'required',
            'motivo_comunicacion_id' => 'required',
            'remitente_id' => 'required'
        ]);
        $this->checkEmpresa($request->input('empresa_id'));
        try {
            DB::beginTransaction();
            $trabajador = Trabajador::findOrFail($request->input('trabajador_id'));
            $comunicacion = $trabajador->comunicacion()->create($request->except('_token', 'trabajador_id'));
            DB::commit();
        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['message' => ':( Error interno contacta a soporte tecnico o intenta nuevamente']);
        }
    }

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

        $trabajador = Trabajador::findOrFail($id);

        $ausente = Ausentismo::with(['ausentismo_tipo'])->where( 'trabajador_id', $trabajador->id)->whereNull('fecha_alta')->get();
        $cita = Event::whereDate('start_date', '>=', \Carbon\Carbon::now()->format('Y-m-d'))->where('trabajador_id', $trabajador->id)->first();

        return view('trabajador.comunicacion.show', compact('trabajador', 'empresa',  'ausente', 'cita'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id, $empresa_id, $trabajador_id)
    {
        $this->checkEmpresa($empresa_id);
        $trabajador = Trabajador::findOrFail($trabajador_id);
        $comunicacion = Comunicacion::findOrFail($id);
        $remitentes = Remitente::get();
        $motivos = MotivoComunicacion::get();
        $modos = ModoComunicacion::get();
        $ausentismos = Ausentismo::where('trabajador_id', $trabajador->id)->get();
        $documentaciones = Documentacion::with(['trabajador', 'user'])->where('trabajador_id', $trabajador->id)->get();

        return view('trabajador.comunicacion._form', compact('comunicacion','remitentes', 'motivos', 'modos', 'ausentismos', 'documentaciones'));
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
        $this->validate($request, [
            'comunicacion.id' => 'required',
            'empresa_id' => 'required',
            'comunicacion.remitente' => 'required',
            'comunicacion.motivo_comunicacion' => 'required'
        ]);

        $this->checkEmpresa($request->input('empresa_id'));

        try {
            DB::beginTransaction();
            $comunicacion = Comunicacion::findOrFail($request->input('comunicacion.id'));

            $data = [
                'remitente_id' => $request->input('comunicacion.remitente') ? $request->input('comunicacion.remitente.id') : null,
                'observacion' => $request->input('comunicacion.observacion'),
                'contenido' => $request->input('comunicacion.contenido'),
                'ausentismo_id' => $request->input('comunicacion.ausentismo') ? $request->input('comunicacion.ausentismo.id') : null,
                'motivo_comunicacion_id' => $request->input('comunicacion.motivo_comunicacion') ? $request->input('comunicacion.motivo_comunicacion.id') : null,
                'modo_comunicacion_id' => $request->input('comunicacion.modo_comunicacion') ? $request->input('comunicacion.modo_comunicacion.id') : null,
                'documentacion_id' => $request->input('comunicacion.documentacion') ? $request->input('comunicacion.documentacion.id') : null
            ];
            $comunicacion->fill($data)->update();

            DB::commit();
        } catch (\Exception $th) {
            DB::rollBack();
            return response()->json(['message' => ':( Error interno contacta a soporte tecnico o intenta nuevamente']);
        }

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
        $comunicacion = Comunicacion::findOrFail($id);

        if( $comunicacion->delete() ) {
            $response = [
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


    /**
     * @param Request $request
     */
    public function getReporteComunicacion(Request $request)
    {
      Excel::create('Reporte Comunicacion', function($excel) use ($request) {

            $excel->sheet('Comunicaciones', function($sheet) use ($request) {

              $products = Comunicacion::where('trabajador_id', $request->input('trabajador_id'))->whereBetween('created_at', array($request->input('fecha_inicio'), $request->input('fecha_fin')))->get();
              $sheet->fromArray($products);

            });
        })->export('xls');
    }

    public function getComTrabajadorJson(Request $request)
    {
        $orderBy = explode('|', $request->get('sort'));
       return response()->json(Comunicacion::with(['trabajador', 'turno', 'remitente', 'modo_comunicacion', 'motivo_comunicacion', 'user', 'documentacion', 'ausentismo'])->where('trabajador_id', $request->get('trabajador_id'))->where('empresa_id', $request->get('empresa_id'))->orderBy($orderBy[0], $orderBy[1])->paginate($request->get('per_page')));
    }

    public function getModoComunicacion()
    {
        return response()->json(ModoComunicacion::all());
    }

    public function getMotivoComunicacion()
    {
        return response()->json(MotivoComunicacion::all());
    }

    public function getAusentismoTrabajadorJson($id)
    {
        return response()->json(Ausentismo::where('trabajador_id', $id)->get());
    }

    public function getDocumentosTrabajadorJson($id)
    {
        return DocumentosTrabajadorResource::collection(Documentacion::with(['documentacion_tipo'])->where('trabajador_id', $id)->get());
    }
}
