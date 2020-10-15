<?php namespace App\Http\Controllers\Empresa;
use App\Models\Proveedor;
use App\Models\PrestacionPresupuesto;
use Illuminate\Http\JsonResponse;
use Imagick;
use App\Models\Empresa;
use App\Models\PrestacionCotizacion;
use App\Models\PrestacionPedido;
use App\Models\PrestacionTipo;
use App\Traits\CheckEmpresaTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Spatie\Activitylog\Models\Activity;

class PrestacionCotizacionController extends Controller
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
            'empresa_id' => 'required',
            'prestacion_pedido_id' => 'required'
        ]);

        $this->checkEmpresa($request->input('empresa_id'));
        $empresa = Empresa::findOrFail($request->input('empresa_id'));
        $prestacion_pedido = PrestacionPedido::findOrFail($request->input('prestacion_pedido_id'));
        $prestacion_cotizacion = PrestacionCotizacion::create($request->except('_token', 'cotizacion_url'));



        if ($request->has('cotizacion_url')) {
            $documentos = $request->file('cotizacion_url');
            foreach($documentos as $i=> $documento){
                $extension = strtolower($documento->getClientOriginalExtension());
                $filePath      = $documento->getRealPath();
                $fileName = uniqid().'.'.$extension;
                //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                $documento->move(storage_path('app/public/empresas/'. $empresa->id. '/prestaciones/'. $prestacion_pedido->id) .'/cotizacion/', $fileName);
                $images[] =  storage_path('app/public/empresas/'. $empresa->id. '/prestaciones/'. $prestacion_pedido->id) .'/cotizacion/'. $fileName;
            }

            //dd($images);

            $pdf= new Imagick($images);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/prestaciones/'. $prestacion_pedido->id.'/cotizacion/') .$filePdfName,true);
            $pdf->clear();
            $pdf->destroy();

            File::delete($images);

            $prestacion_cotizacion->cotizacion_url = $filePdfName;
            $prestacion_cotizacion->save();
        }

        $prestacion_pedido->estado = 2;
        $prestacion_pedido->save();

        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'fail' => false,
                'text' => 'La cotizacion fue creada exitosamente..!',
                'redirect_url' => route('empresa.prestacion.pedido.show', ['id' => $prestacion_pedido->id, 'id_empresa' => $request->input('empresa_id')])
            ]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($cotizacion_id, $empresa_id, $pedido_id)
    {
        $this->checkEmpresa($empresa_id);
        $prestacion_cotizacion = PrestacionCotizacion::findOrFail($cotizacion_id);
        $prestacion_pedido = PrestacionPedido::findOrFail($pedido_id);
        $empresa = Empresa::findOrFail($empresa_id);
        $proveedores = Proveedor::get();


        return view('empresa.prestacion.cotizacion_form', compact('prestacion_cotizacion', 'empresa', 'prestacion_pedido', 'proveedores'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cotizacion_id, $prestacion_pedido_id)
    {
        $this->checkEmpresa($request->input('empresa_id'));
        Empresa::findOrFail($request->input('empresa_id'));
        $prestacion_cotizacion = PrestacionCotizacion::findOrFail($cotizacion_id);
        $prestacion_pedido = PrestacionPedido::findOrFail($prestacion_pedido_id);

        $prestacion_cotizacion->aprobado = true;
        $prestacion_cotizacion->save();

        if ($request->has('cotizacion_url')) {
            $documentos = $request->file('cotizacion_url');
            foreach($documentos as $i=> $documento){
                $extension = strtolower($documento->getClientOriginalExtension());
                $filePath      = $documento->getRealPath();
                $fileName = uniqid().'.'.$extension;
                //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                $documento->move(storage_path('app/public/empresas/'. $empresa->id. '/prestaciones/'. $prestacion_pedido->id) .'/cotizacion/', $fileName);
                $images[] =  storage_path('app/public/empresas/'. $empresa->id. '/prestaciones/'. $prestacion_pedido->id) .'/cotizacion/'. $fileName;
            }

            //dd($images);

            $pdf= new Imagick($images);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/prestaciones/'. $prestacion_pedido->id.'/cotizacion/') .$filePdfName,true);
            $pdf->clear();
            $pdf->destroy();

            File::delete($images);

            $prestacion_cotizacion->cotizacion_url = $filePdfName;
            $prestacion_cotizacion->save();
        }


        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'status' => 'success',
                'text' => 'La cotizacion fue aprobada exitosamente..!',
                'redirect_url' => route('empresa.prestacion.pedido.show', ['id' => $prestacion_pedido->id, 'id_empresa' => $request->input('empresa_id')])
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $this->checkEmpresa($request->input('empresa_id'));
        $cotizacion = PrestacionCotizacion::findOrFail($id);

        if( $cotizacion->delete() ) {
            $response = [
                'id'        =>  $cotizacion->id,
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
