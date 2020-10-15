<?php

namespace App\Http\Controllers\Trabajador;



use Imagick;

use App\Models\Empresa;
use App\Models\Ausentismo;
use App\Models\Trabajador;
use App\Models\Documentacion;
use App\Models\DocumentacionTipo;
use UrlSigner;
use App\Traits\CheckEmpresaTrait;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use Spatie\Activitylog\Models\Activity;

use Spatie\PdfToImage\Pdf;

/**
 * Class DocumentacionController
 * @package App\Http\Controllers\Trabajador
 */
class DocumentacionController extends Controller
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
            'fecha_documento' => 'required|date',
            'fecha_entrega' => 'required|date',
            'documentacion_tipo_id' => 'required'
        );
        $validator = $this->validate($request,$rules);
        $this->checkEmpresa($request->input('empresa_id'));
        $empresa = Empresa::findOrFail($request->input('empresa_id'));
        $trabajador = Trabajador::findOrFail($request->input('trabajador_id'));

        $documentacion = $trabajador->documentacion()->create($request->except('_token'));


        if ($request->hasFile('documentos')) {
            $documentos = $request->file('documentos');
            foreach($documentos as $i=> $documento){
                $extension = strtolower($documento->getClientOriginalExtension());
                $filePath      = $documento->getRealPath();
                $fileName = uniqid().'.'.$extension;
                //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                $documento->move(storage_path('app/public/empresas/'. $empresa->id. '/trabajadores/'. $trabajador->id . '/documentacion_laboral/'. $documentacion->id) .'/', $fileName);
                $images[] =  storage_path('app/public/empresas/'. $empresa->id. '/trabajadores/'. $trabajador->id . '/documentacion_laboral/'. $documentacion->id) . '/'. $fileName;
            }


            $pdf= new Imagick($images);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/trabajadores/'. $trabajador->id . '/documentacion_laboral/'. $documentacion->id) .'/'. $filePdfName,true);
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
                'text' => 'La documentacion fue creada exitosamente..!',
                'redirect_url' => route('trabajador.documentacion.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id] )
            ]);
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

         $trabajador = Trabajador::with(['documentacion.trabajador', 'documentacion.user'])->findOrFail($id);

         $documentacion_tipos = DocumentacionTipo::get();
          $ausentismos = Ausentismo::where('trabajador_id', $trabajador->id)->get();


         return view('trabajador.documentacion.show', compact('trabajador', 'empresa', 'documentacion_tipos', 'ausentismos'));
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
        $empresa = Empresa::findOrFail($empresa_id);

        $documentacion_tipos = DocumentacionTipo::get();
        $documentacion = Documentacion::findOrFail($id);
        $ausentismos = Ausentismo::where('trabajador_id', $trabajador->id)->get();


        return view('trabajador.documentacion._form', compact('documentacion_tipos','documentacion', 'trabajador', 'empresa', 'ausentismos'));

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
        $empresa = Empresa::findOrFail($request->input('empresa_id'));
        $trabajador = Trabajador::findOrFail($request->input('trabajador_id'));

        $documentacion = Documentacion::findOrFail($id);
        $documentacion->fill($request->except('_token'))->update();

        if ($request->hasFile('documentos')) {
            $documentos = $request->file('documentos');
            foreach($documentos as $i=> $documento){
                $extension = strtolower($documento->getClientOriginalExtension());
                $filePath      = $documento->getRealPath();
                $fileName = uniqid().'.'.$extension;
                //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                $documento->move(storage_path('app/public/empresas/'. $empresa->id. '/trabajadores/'. $trabajador->id . '/documentacion_laboral/'. $documentacion->id) .'/', $fileName);
                $images[] =  storage_path('app/public/empresas/'. $empresa->id. '/trabajadores/'. $trabajador->id . '/documentacion_laboral/'. $documentacion->id) . '/'. $fileName;
            }

            //dd($images);

            $pdf= new Imagick($images);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/trabajadores/'. $trabajador->id . '/documentacion_laboral/'. $documentacion->id) .'/'. $filePdfName,true);
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
                'redirect_url' => route('trabajador.documentacion.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id] )
            ]);
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
        $trabajador = Trabajador::find($request->input('trabajador_id'));
        $documentacion = Documentacion::findOrFail($id);


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
     * @param $trabajador_id
     * @param $filename
     * @param $documento_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generateUrl($empresa_id, $trabajador_id, $filename, $documento_id)
    {
        $this->checkEmpresa($empresa_id);

        $url = UrlSigner::sign(route('trabajador.documentacion.download',['trabajador_id' => $trabajador_id, 'filename' => $filename, 'empresa_id' => $empresa_id, 'documento_id' => $documento_id]), Carbon::now()->addSeconds(10));
        return redirect()->to($url);
    }


    /**
     * @param $trabajador_id
     * @param $filename
     * @param $empresa_id
     * @param $documento_id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($trabajador_id, $filename, $empresa_id, $documento_id)
    {
        return response()->download(storage_path("storage/empresas/$empresa_id/trabajadores/$trabajador_id/documentacion_laboral/$documento_id/$filename"));
    }
}
