<?php namespace App\Http\Controllers\Empresa;

use Imagick;

use App\Models\Empresa;
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

use Illuminate\Support\Facades\File;

use Spatie\Activitylog\Models\Activity;

/**
 * Class PrestacionPedidoController
 * @package App\Http\Controllers\Empresa
 */
class PrestacionPedidoController extends Controller
{
    use CheckEmpresaTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_empresa)
    {
        $this->checkEmpresa($id_empresa);
        $empresa = Empresa::with(['prestacion_pedido.trabajador', 'prestacion_pedido.prestacion_tipo'])->findOrFail($id_empresa);
        $prestacion_tipos = PrestacionTipo::where('tipo', 'e')->get();


        return view('empresa.prestacion.index', compact('empresa', 'prestacion_tipos'));
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

        $prestacion_pedido = PrestacionPedido::create($request->except('_token', 'presupuesto_url', 'orden_servicio_url', 'reporte_url'));

        if ($request->input('prestacion_tipo_id') == 1) {
            $prestacion_pedido->estado = 4;
            $prestacion_pedido->save();
        }
        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'fail' => false,
                'text' => 'La prestacion fue creada exitosamente..!',
                'redirect_url' => route('empresa.prestacion.pedido.index', ['id' => $empresa->id, 'name' => $empresa->nombre] )
            ]);
        }
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
        $prestacion_pedido = PrestacionPedido::findOrFail($id);
        $proveedores = Proveedor::where('prestacion_tipo_id', $prestacion_pedido->prestacion_tipo_id)->get();
        $prestacion_cotizaciones = PrestacionCotizacion::where('prestacion_pedido_id',$prestacion_pedido->id)->get();
        $prestacion_presupuestos = PrestacionPresupuesto::where('prestacion_pedido_id', $prestacion_pedido->id)->get();
        $ordene_servicios = OrdenServicio::where('prestacion_pedido_id', $prestacion_pedido->id)->get();
        $informe_servicios = InformeServicio::where('prestacion_pedido_id', $prestacion_pedido->id)->get();
        $orden_servicio = OrdenServicio::where('prestacion_pedido_id', $prestacion_pedido->id)->first();

        return view('empresa.prestacion.show', compact('empresa', 'prestacion_pedido', 'proveedores', 'prestacion_cotizaciones', 'prestacion_presupuestos', 'ordene_servicios', 'informe_servicios', 'orden_servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $id_empresa)
    {
        $this->checkEmpresa($id_empresa);

        $empresa = Empresa::findOrFail($id_empresa);
        $prestacion_tipos = PrestacionTipo::get();
        $prestacion_pedido = PrestacionPedido::findOrFail($id);

        return view('empresa.prestacion._form', compact('empresa', 'prestacion_tipos', 'prestacion_pedido'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $id_empresa)
    {
        $this->checkEmpresa($id_empresa);

        $prestacion_pedido = PrestacionPedido::findOrFail($id);
        $empresa = Empresa::findOrFail($id_empresa);

        $prestacion_pedido->fill($request->except('_token', '_method', 'empresa', 'prestacion_tipos', 'prestacion_pedido'))->update();

        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'fail' => false,
                'text' => 'La prestacion fue creada exitosamente..!',
                'redirect_url' => route('empresa.prestacion.pedido.index', ['id' => $empresa->id, 'name' => $empresa->nombre] )
            ]);
        }
    }


    /**
     * @param Request $request
     * @param $id
     * @param $id_empresa
     * @return \Illuminate\Http\RedirectResponse
     * @throws \ImagickException
     */
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
              $documento->move(storage_path('app/public/empresas/'. $empresa->id. '/prestaciones/'. $prestacion_pedido->id) .'/reporte_servicio/', $fileName);
              $images[] =  storage_path('app/public/empresas/'. $empresa->id. '/prestaciones/'. $prestacion_pedido->id) .'/reporte_servicio/'. $fileName;
          }

          //dd($images);

          $pdf= new Imagick($images);
          $pdf->setImageFormat('pdf');
          $filePdfName = uniqid().'.pdf';
          $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/prestaciones/'. $prestacion_pedido->id.'/reporte_servicio/') .$filePdfName,true);
          $pdf->clear();
          $pdf->destroy();

          File::delete($images);


          $prestacion_pedido->reporte_url = $filePdfName;
          $prestacion_pedido->estado = 6;
          $prestacion_pedido->save();
      }



      return redirect()->route('empresa.prestacion.pedido.show', ['id' => $prestacion_pedido->id, 'id_empresa' => $empresa->id]);
    }

    /**
     * @param Request $request
     * @param $id
     * @param $id_empresa
     * @return \Illuminate\Http\RedirectResponse
     */
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
