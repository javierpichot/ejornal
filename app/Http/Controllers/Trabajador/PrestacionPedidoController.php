<?php namespace App\Http\Controllers\Trabajador;

use Imagick;

use App\Mail\SendNotificationMedicoDomicilio;

use App\Models\Empresa;
use App\Models\Ausentismo;
use App\Models\Trabajador;
use App\Models\OrdenServicio;
use App\Models\InformeServicio;
use App\Models\PrestacionCotizacion;
use App\Models\PrestacionPedido;
use App\Models\PrestacionTipo;
use App\Models\Proveedor;
use App\Models\PrestacionPresupuesto;
use App\Traits\CheckEmpresaTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

use Spatie\Activitylog\Models\Activity;

class PrestacionPedidoController extends Controller
{
    use CheckEmpresaTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $name, $empresa_id)
    {
        $this->checkEmpresa($empresa_id);
        $empresa = Empresa::findOrFail($empresa_id);
        $trabajador = Trabajador::with(['prestacion_pedido', 'prestacion_pedido.prestacion_tipo'])->findOrFail($id);
        $prestacion_tipos = PrestacionTipo::where('tipo', 't')->get();

        $ausentismos = Ausentismo::where('trabajador_id', $trabajador->id)->get();



        return view('trabajador.prestacion.index', compact('empresa', 'prestacion_tipos', 'trabajador', 'ausentismos'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->checkEmpresa($request->input('empresa_id'));
        $empresa = Empresa::findOrFail($request->input('empresa_id'));
        $trabajador = Trabajador::findOrFail($request->input('trabajador_id'));



        $prestacion_pedido = $trabajador->prestacion_pedido()->create($request->except('_token', 'presupuesto_url', 'orden_servicio_url', 'reporte_url'));

        if ($request->input('prestacion_tipo_id') == 1) {
            $prestacion_pedido->estado = 4;
            $prestacion_pedido->save();
        }





        if ($request->input('prestacion_tipo_id') == 1) {
            $proveedor = Proveedor::where('prestacion_tipo_id', 1)->orderBy(DB::raw('RAND()'))->first();

            $url = route('medico.domicilio.show', ['id' => $trabajador->id, 'prestacion_id' => $prestacion_pedido->id]);

            Mail::to($proveedor->email)->send(new SendNotificationMedicoDomicilio($proveedor, $empresa, $trabajador, $prestacion_pedido, $url));
        }


        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'fail' => false,
                'text' => 'La prestacion fue creada exitosamente..!',
                'redirect_url' => route('empresa.prestacion.pedido.index', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id] )
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $name, $trabajador_id, $empresa_id)
    {
        $empresa = Empresa::findOrFail($empresa_id);
        $trabajador = Trabajador::findOrFail($trabajador_id);
        $prestacion_pedido = PrestacionPedido::findOrFail($id);
        $proveedores = Proveedor::where('prestacion_tipo_id', $prestacion_pedido->prestacion_tipo_id)->get();
        $prestacion_cotizaciones = PrestacionCotizacion::where('prestacion_pedido_id',$prestacion_pedido->id)->get();
        $prestacion_presupuestos = PrestacionPresupuesto::where('prestacion_pedido_id', $prestacion_pedido->id)->get();
        $ordene_servicios = OrdenServicio::where('prestacion_pedido_id', $prestacion_pedido->id)->get();
        $informe_servicios = InformeServicio::where('prestacion_pedido_id', $prestacion_pedido->id)->get();
        $orden_servicio = OrdenServicio::where('prestacion_pedido_id', $prestacion_pedido->id)->first();


        return view('trabajador.prestacion.show', compact('empresa', 'prestacion_pedido', 'proveedores', 'prestacion_cotizaciones', 'prestacion_presupuestos', 'ordene_servicios', 'informe_servicios', 'orden_servicio', 'trabajador'));
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

        $empresa = Empresa::findOrFail($empresa_id);
        $trabajador = Trabajador::findOrFail($trabajador_id);
        $prestacion_tipos = PrestacionTipo::get();
        $prestacion_pedido = PrestacionPedido::findOrFail($id);
        $ausentismos = Ausentismo::where('trabajador_id', $trabajador->id)->get();

        return view('trabajador.prestacion._form', compact('empresa', 'prestacion_tipos', 'prestacion_pedido', 'trabajador', 'ausentismos'));
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
        $this->checkEmpresa($request->input('empresa_id'));
        $trabajador = Trabajador::find($request->input('trabajador_id'));

        $prestacion_pedido = PrestacionPedido::findOrFail($id);
        $empresa = Empresa::findOrFail($request->input('empresa_id'));



        $prestacion_pedido->fill($request->except('_token', '_method', 'empresa', 'prestacion_tipos', 'prestacion_pedido'))->update();

        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'fail' => false,
                'text' => 'La prestacion fue creada exitosamente..!',
                'redirect_url' => route('trabajador.prestacion.pedido.index', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id] )
            ]);
        }
    }


    public function getUpdateReporte(Request $request, $id, $id_empresa)
    {
      $this->checkEmpresa($id_empresa);

      $prestacion_pedido = PrestacionPedido::findOrFail($id);
      $empresa = Empresa::findOrFail($id_empresa);

      $prestacion_pedido->reporte = $request->input('reporte');
      $prestacion_pedido->feedback = $request->input('feedback');

      if ($request->has('reporte_url')) {
          $documentos = $request->file('reporte_url');
          foreach($documentos as $i=> $documento){
              $extension = strtolower($documento->getClientOriginalExtension());
              $filePath      = $documento->getRealPath();
              $fileName = uniqid().'.'.$extension;
              //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
              $documento->move(storage_path('/empresas/'. $empresa->id) .'/', $fileName);
              $images[] =  storage_path().'/empresas/'. $empresa->id . '/'. $fileName;
          }

          //dd($images);

          $pdf= new Imagick($images);
          $pdf->setImageFormat('pdf');
          $filePdfName = uniqid().'.pdf';
          $pdf->writeImages(storage_path().'/empresas/'. $empresa->id .'/'.$filePdfName,true);
          $pdf->clear();
          $pdf->destroy();


          $prestacion_pedido->reporte_url = $filePdfName;
          $prestacion_pedido->estado = 6;
          $prestacion_pedido->save();
      }



      return redirect()->route('empresa.prestacion.pedido.show', ['id' => $prestacion_pedido->id, 'id_empresa' => $empresa->id]);
    }

    public function getClosePedido(Request $request, $id, $id_empresa)
    {
      $this->checkEmpresa($id_empresa);

      $prestacion_pedido = PrestacionPedido::findOrFail($id);
      $empresa = Empresa::findOrFail($id_empresa);
      $prestacion_pedido->estado = 7;
      $prestacion_pedido->save();
      return redirect()->route('empresa.prestacion.pedido.show', ['id' => $prestacion_pedido->id, 'id_empresa' => $empresa->id]);
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
         $trabajador = Trabajador::find($request->input('trabajador_id'));
         $prestacion_pedido = PrestacionPedido::findOrFail($id);

         if( $prestacion_pedido->delete() ) {
             $response = [
                 'id'        =>  $prestacion_pedido->id,
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
