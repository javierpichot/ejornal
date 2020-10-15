<?php namespace App\Http\Controllers\Empresa;



use App\Http\Controllers\Controller;
use Imagick;
use App\Models\Ausentismo;
use App\Models\DocumentacionEmpresa;
use App\Models\DocumentacionEmpresaTipo;
use App\Models\DocumentacionTipo;
use App\Models\Empresa;
use App\Models\Documentacion;
use App\Traits\CheckEmpresaTrait;

use Carbon\Carbon;
use OwenIt\Auditing\Facades\Auditor;
use UrlSigner;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Spatie\Activitylog\Models\Activity;

/**
 * Class DocumentacionController
 * @package App\Http\Controllers\Empresa
 */
class DocumentacionController extends Controller
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
        $empresa = Empresa::with(['documentacion_empresa'])->findOrFail($id_empresa);
        $documentacion_tipos = DocumentacionEmpresaTipo::get();
        return view('empresa.documentacion.index', compact('empresa', 'documentacion_tipos'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required',
            'empresa_id' => 'required',
            'documentacion_empresa_tipo_id' => 'required',
            'documentos' => 'required'
        ]);

        $this->checkEmpresa($request->input('empresa_id'));
        $empresa = Empresa::findOrFail($request->input('empresa_id'));

        $documentacion = DocumentacionEmpresa::create($request->except('_token', 'documentos'));

        if ($request->has('documentos')) {
            $documentos = $request->file('documentos');
            foreach($documentos as $i=> $documento){
                $extension = strtolower($documento->getClientOriginalExtension());
                $filePath      = $documento->getRealPath();
                $fileName = uniqid().'.'.$extension;
                  $documento->move(storage_path('app/public/empresas/'. $empresa->id. '/documentacion_empresa/'. $documentacion->id) .'/', $fileName);
                $images[] =  storage_path('app/public/empresas/'. $empresa->id. '/documentacion_empresa/'. $documentacion->id) . '/'. $fileName;
            }

            $pdf= new Imagick($images);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/documentacion_empresa/'. $documentacion->id) .'/'.$filePdfName,true);
            $pdf->clear();
            $pdf->destroy();

           // File::delete($images);

            $documentacion->url = $filePdfName;
            $documentacion->save();
        }
        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'fail' => false,
                'text' => 'La documentacion fue creada exitosamente..!',
                'redirect_url' => route('empresa.documentos.index', ['id' => $empresa->id, 'name' => $empresa->nombre] )
            ]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Documentacion  $documentacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id, $empresa_id)
    {
        $this->checkEmpresa($empresa_id);
        $empresa = Empresa::findOrFail($empresa_id);

        $documentacion_tipos = DocumentacionEmpresaTipo::get();
        $documentacion = DocumentacionEmpresa::findOrFail($id);


        return view('empresa.documentacion._form', compact('documentacion_tipos','documentacion', 'empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Documentacion  $documentacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->checkEmpresa($request->input('empresa_id'));
        $empresa = Empresa::findOrFail($request->input('empresa_id'));

        $documentacion = DocumentacionEmpresa::findOrFail($id);
        $documentacion->fill($request->except('_token', 'documentos'))->update();

        if ($audit = Auditor::execute($documentacion)) {
            Auditor::prune($documentacion);
        }

        if ($request->has('documentos')) {
            $documentos = $request->file('documentos');
            foreach($documentos as $i=> $documento){
                $extension = strtolower($documento->getClientOriginalExtension());
                $filePath      = $documento->getRealPath();
                $fileName = uniqid().'.'.$extension;
                  $documento->move(storage_path('app/public/empresas/'. $empresa->id. '/documentacion_empresa/'. $documentacion->id) .'/', $fileName);
                $images[] =  storage_path('app/public/empresas/'. $empresa->id. '/documentacion_empresa/'. $documentacion->id) . '/'. $fileName;
            }

            //dd($images);

            $pdf= new Imagick($images);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/documentacion_empresa/'. $documentacion->id) .'/'.$filePdfName,true);
            $pdf->clear();
            $pdf->destroy();

            File::delete($images);

            $documentacion->url = $filePdfName;
            $documentacion->save();
        }

        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'fail' => false,
                'text' => 'La documentacion fue actualizada exitosamente..!',
                'redirect_url' => route('empresa.documentos.index', ['id' => $empresa->id, 'name' => $empresa->nombre] )
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Documentacion  $documentacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->checkEmpresa($request->input('empresa_id'));
        $documentacion = DocumentacionEmpresa::findOrFail($id);

        if( $documentacion->delete() ) {
            $response = [
                'id'        =>  $documentacion->id,
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
     * @param $empresa_id
     * @param $filename
     * @param $prestacion_pedido_id
     * @param $type
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generateUrl($empresa_id, $filename, $prestacion_pedido_id, $type)
    {
        $url = UrlSigner::sign(route('empresa.documentacion.download',['empresa_id' => $empresa_id, 'filename' => $filename, 'prestacion_pedido_id' => $prestacion_pedido_id, 'type' => $type]), Carbon::now()->addSeconds(10));
        return redirect()->to($url);
    }


    /**
     * @param $empresa_id
     * @param $filename
     * @param $prestacion_pedido_id
     * @param $type
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($empresa_id, $filename, $prestacion_pedido_id, $type)
    {
        return response()->download(storage_path("app/public/empresas/$empresa_id/prestaciones/$prestacion_pedido_id/$type/{$filename}"));
    }

    /**
     * @param $empresa_id
     * @param $filename
     * @param $prestacion_pedido_id
     * @param $type
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generateUrlDocmunetacion($empresa_id, $filename, $prestacion_pedido_id, $type)
    {
        $url = UrlSigner::sign(route('empresa.documentacion.empresa.download',['empresa_id' => $empresa_id, 'filename' => $filename, 'prestacion_pedido_id' => $prestacion_pedido_id, 'type' => $type]), Carbon::now()->addSeconds(10));
        return redirect()->to($url);
    }

    /**
     * @param $empresa_id
     * @param $filename
     * @param $id
     * @param $type
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadDocumentacionEmpresa($empresa_id, $filename, $id, $type)
    {
        return response()->download(storage_path("app/public/empresas/$empresa_id/$type/$id/{$filename}"));
    }


}
