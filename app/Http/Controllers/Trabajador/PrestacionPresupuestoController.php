<?php namespace App\Http\Controllers\Trabajador;

use App\Models\PrestacionPresupuesto;
use Illuminate\Http\JsonResponse;
use Imagick;

use App\Models\Empresa;
use App\Models\PrestacionPedido;

use App\Traits\CheckEmpresaTrait;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Spatie\Activitylog\Models\Activity;

class PrestacionPresupuestoController extends Controller
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
        $presupuesto = $prestacion_pedido->prestacion_presupuesto()->create($request->except('_token', 'presupuesto_url'));



        if ($request->has('presupuesto_url')) {
            $documentos = $request->file('presupuesto_url');
            foreach($documentos as $i=> $documento){
                $extension = strtolower($documento->getClientOriginalExtension());
                $filePath      = $documento->getRealPath();
                $fileName = uniqid().'.'.$extension;
                //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                $documento->move(storage_path('app/public/empresas/'.$prestacion_pedido->empresa->id. '/trabajadores/'. $prestacion_pedido->trabajador->id .'/presupuesto/' . $presupuesto->id ) .'/', $fileName);

                $images[] =  storage_path('app/public/empresas/'.$prestacion_pedido->empresa->id. '/trabajadores/'. $prestacion_pedido->trabajador->id .'/presupuesto/' . $presupuesto->id ) . '/'. $fileName;
            }

            //dd($images);

            $pdf= new Imagick($images);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'.$prestacion_pedido->empresa->id. '/trabajadores/'. $prestacion_pedido->trabajador->id .'/presupuesto/' . $presupuesto->id ) .'/'.$filePdfName,true);
            $pdf->clear();
            $pdf->destroy();

            File::delete($images);

            $presupuesto->presupuesto_url = $filePdfName;
            $presupuesto->save();
        }

        $prestacion_pedido->estado = 3;
        $prestacion_pedido->save();

        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'fail' => false,
                'text' => 'El presupuesto fue creado exitosamente..!',
                'redirect_url' => route('empresa.prestacion.pedido.show', ['id' => $prestacion_pedido->id, 'id_empresa' => $request->input('empresa_id')])
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $prestacion_presupuesto_id, $prestacion_pedido_id)
    {
        $this->checkEmpresa($request->input('empresa_id'));
        $empresa = Empresa::findOrFail($request->input('empresa_id'));
        $prestacion_presupuesto = PrestacionPresupuesto::findOrFail($prestacion_presupuesto_id);
        $prestacion_pedido = PrestacionPedido::findOrFail($prestacion_pedido_id);

        $prestacion_pedido->estado = 4;
        $prestacion_pedido->save();


        if ($request->has('presupuesto_url')) {
            $documentos = $request->file('presupuesto_url');
            foreach($documentos as $i=> $documento){
                $extension = strtolower($documento->getClientOriginalExtension());
                $filePath      = $documento->getRealPath();
                $fileName = uniqid().'.'.$extension;
                //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                $documento->move(storage_path('app/public/empresas/'.$prestacion_pedido->empresa->id. '/trabajadores/'. $prestacion_pedido->trabajador->id .'/presupuesto/' . $presupuesto->id ) .'/', $fileName);

                $images[] =  storage_path('app/public/empresas/'.$prestacion_pedido->empresa->id. '/trabajadores/'. $prestacion_pedido->trabajador->id .'/presupuesto/' . $presupuesto->id ) . '/'. $fileName;
            }

            //dd($images);

            $pdf= new Imagick($images);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'.$prestacion_pedido->empresa->id. '/trabajadores/'. $prestacion_pedido->trabajador->id .'/presupuesto/' . $presupuesto->id ) .'/'.$filePdfName,true);
            $pdf->clear();
            $pdf->destroy();

            File::delete($images);

            $presupuesto->presupuesto_url = $filePdfName;
            $presupuesto->save();
        }

        $prestacion_presupuesto->aprobado = true;
        $prestacion_presupuesto->save();


        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'status' => 'success',
                'text' => 'El presupuesto fue aprobado exitosamente..!',
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
        $prestacion_presupuesto = PrestacionPresupuesto::findOrFail($id);

        activity()
           ->performedOn($prestacion_presupuesto)
           ->causedBy(auth()->user())
           ->withProperties(['attributes' => $prestacion_presupuesto, 'ip' => $request->ip(), 'method' => $request->method()])
           ->log('destroy');

        $lastLoggedActivity = Activity::all()->last();
        $lastLoggedActivity->subject; //returns an instance of an eloquent model
        $lastLoggedActivity->causer; //returns an instance of your user model
        $lastLoggedActivity->description; //returns 'Look, I logged something'

        if( $prestacion_presupuesto->delete() ) {
            $response = [
                'id'        =>  $prestacion_presupuesto->id,
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
