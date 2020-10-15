<?php

namespace App\Http\Controllers\Empresa;

use Imagick;

use App\Models\Empresa;
use App\Models\RevisionPeriodica;
use App\Models\RevisionPeriodicaTipo;
use App\Models\RevisionPeriodicaEntidad;



use App\Traits\CheckEmpresaTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\File;

use Spatie\Activitylog\Models\Activity;

class RevisionPeriodicaController extends Controller
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
        $empresa = Empresa::with(['revision_periodica_entidad'])->findOrFail($id_empresa);
        $revision_periodicas = RevisionPeriodica::with(['user', 'revision_periodica_entidad.empresa'])->get();

        $revision_periodica_entidad = RevisionPeriodicaEntidad::where('empresa_id', $empresa->id)->get();
        $revision_periodica_tipos = RevisionPeriodicaTipo::get();

        return view('empresa.revision-periodica.index', compact('empresa', 'revision_periodicas', 'revision_periodica_entidad', 'revision_periodica_tipos'));
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
        $revision_periodica_entidad = RevisionPeriodicaEntidad::findOrFail($request->input('revision_periodica_entidad_id'));

        $revision_periodica = $revision_periodica_entidad->revision_periodica()->create($request->except('_token', 'fotos'));

        if ($request->has('fotos')) {
            $fotos = $request->file('fotos');
            foreach($fotos as $i=> $foto){
                $extension = strtolower($foto->getClientOriginalExtension());
                $filePath      = $foto->getRealPath();
                $fileName = uniqid().'.'.$extension;
                //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                $foto->move(storage_path('app/public/empresas/'. $empresa->id. '/revisiones_periodicas/'. $revision_periodica->id) .'/', $fileName);
                $images[] =  storage_path('app/public/empresas/'. $empresa->id. '/revisiones_periodicas/'. $revision_periodica->id) . '/'. $fileName;
            }

            //dd($images);

            $pdf= new Imagick($images);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/revisiones_periodicas/'. $revision_periodica->id) .'/'.$filePdfName,true);
            $pdf->clear();
            $pdf->destroy();

            File::delete($images);


            $revision_periodica->fotos = $filePdfName;
            $revision_periodica->save();
        }

        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'fail' => false,
                'text' => 'La documentacion fue creada exitosamente..!',
                'redirect_url' => route('empresa.revision-periodicas.index', ['id' => $empresa->id, 'name' => $empresa->nombre] )
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id, $empresa_id)
    {
        $this->checkEmpresa($empresa_id);
        $empresa = Empresa::findOrFail($empresa_id);

        $revision_periodica = RevisionPeriodica::findOrFail($id);
        $revision_periodica_entidad = RevisionPeriodicaEntidad::get();
        $revision_periodica_tipos = RevisionPeriodicaTipo::get();


        return view('empresa.revision-periodica._form', compact('revision_periodica', 'empresa', 'revision_periodica_entidad', 'revision_periodica_tipos'));
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
        $revision_periodica = RevisionPeriodica::findOrFail($id);
        $revision_periodica->fill($request->except('_token', 'fotos'))->update();

        if ($request->has('fotos')) {
            $fotos = $request->file('fotos');
            foreach($fotos as $i=> $foto){
                $extension = strtolower($foto->getClientOriginalExtension());
                $filePath      = $foto->getRealPath();
                $fileName = uniqid().'.'.$extension;
                //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                $foto->move(storage_path('app/public/empresas/'. $empresa->id. '/revisiones_periodicas/'. $revision_periodica->id) .'/', $fileName);
                $images[] = storage_path('app/public/empresas/'. $empresa->id. '/revisiones_periodicas/'. $revision_periodica->id) . '/'. $fileName;
            }

            //dd($images);

            $pdf= new Imagick($images);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/revisiones_periodicas/'. $revision_periodica->id) .'/'.$filePdfName,true);
            $pdf->clear();
            $pdf->destroy();


            $revision_periodica->fotos = $filePdfName;
            $revision_periodica->save();
        }

        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'fail' => false,
                'text' => 'La documentacion fue creada exitosamente..!',
                'redirect_url' => route('empresa.revision-periodicas.index', ['id' => $empresa->id, 'name' => $empresa->nombre] )
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
         $revision_periodica = RevisionPeriodica::findOrFail($id);

         if( $revision_periodica->delete() ) {
             $response = [
                 'id'        =>  $revision_periodica->id,
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
