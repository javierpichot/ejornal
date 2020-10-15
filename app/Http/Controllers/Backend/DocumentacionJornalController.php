<?php

namespace App\Http\Controllers\Backend;

use Imagick;

use App\Models\DocumentacionJornal;
use App\Models\DocumentacionEmpresaTipo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DocumentacionJornalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentacion_jornals = DocumentacionJornal::with(['documentacion_empresa_tipo', 'user'])->get();
        return view('backend.documentacion_jornal.index', compact('documentacion_jornals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $documentacion_empresa_tipo = DocumentacionEmpresaTipo::get();

        return view('backend.documentacion_jornal.create', compact('documentacion_empresa_tipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $documento_jornal = DocumentacionJornal::create($request->except('_token', 'documentos'));
        if ($request->has('documentos')) {
            $documentos = $request->file('documentos');
            foreach($documentos as $i=> $documento){
                $extension = strtolower($documento->getClientOriginalExtension());
                $filePath      = $documento->getRealPath();
                $fileName = uniqid().'.'.$extension;
                //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                $documento->move(storage_path('app/public/jornal/documentacion/'. $documento_jornal->id) .'/', $fileName);
                $images[] = storage_path('app/public/jornal/documentacion/'. $documento_jornal->id). '/'. $fileName;
            }

            //dd($images);

            $pdf= new Imagick($images);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/jornal/documentacion/'. $documento_jornal->id).'/'.$filePdfName,true);
            $pdf->clear();
            $pdf->destroy();

            File::delete($images);

            $documento_jornal->url = $filePdfName;
            $documento_jornal->save();
        }

        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.documento_jornal.index');

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $documentacion_empresa_tipo = DocumentacionEmpresaTipo::get();
        $documentacion_jornal = DocumentacionJornal::with(['documentacion_empresa_tipo', 'user'])->findOrFail($id);
        return view('backend.documentacion_jornal.edit', compact('documentacion_jornal', 'documentacion_empresa_tipo'));
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
        $documento_jornal = DocumentacionJornal::findOrFail($id);
        $documento_jornal->fill($request->except('_token', 'documentos'))->update();

        if ($request->has('documentos')) {
            $documentos = $request->file('documentos');
            foreach($documentos as $i=> $documento){
                $extension = strtolower($documento->getClientOriginalExtension());
                $filePath      = $documento->getRealPath();
                $fileName = uniqid().'.'.$extension;
                //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                $documento->move(storage_path('app/public/jornal/documentacion/'. $documento_jornal->id) .'/', $fileName);
                $images[] = storage_path('app/public/jornal/documentacion/'. $documento_jornal->id). '/'. $fileName;
            }

            //dd($images);

            $pdf= new Imagick($images);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/jornal/documentacion/'. $documento_jornal->id).'/'.$filePdfName,true);
            $pdf->clear();
            $pdf->destroy();

            File::delete($images);

            $documento_jornal->url = $filePdfName;
            $documento_jornal->save();
        }

        Session::flash('alert', 'Los datos se han actualizado exitosamente.');
        return redirect()->route('admin.documento_jornal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documento_jornal = DocumentacionJornal::findOrFail($id);
        if( $documento_jornal->delete() ) {
            $response = [
                'id'        =>  $documento_jornal->id,
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
