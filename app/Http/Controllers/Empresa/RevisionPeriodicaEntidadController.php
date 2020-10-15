<?php

namespace App\Http\Controllers\Empresa;

use App\Models\TipoTarea;
use Imagick;

use App\Models\Empresa;
use Caffeinated\Shinobi\Models\Role;


use App\Traits\CheckEmpresaTrait;
use Illuminate\Http\Request;
use App\Models\RevisionPeriodicaEntidad;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Models\Activity;

class RevisionPeriodicaEntidadController extends Controller
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
        $roles = Role::get();
        $tipo_tareas = TipoTarea::get();

        $empresa = Empresa::with(['revision_periodica_entidad.role'])->findOrFail($id_empresa);


        return view('empresa.revision-periodica-entidad.index', compact('empresa','roles', 'tipo_tareas'));
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

        $revision_periodica_entidad = $empresa->revision_periodica_entidad()->create($request->except('_token', 'foto'));

        if ($request->has('foto')) {
            $fotos = $request->file('foto');
            foreach($fotos as $i=> $foto){
                $extension = strtolower($foto->getClientOriginalExtension());
                $filePath      = $foto->getRealPath();
                $fileName = uniqid().'.'.$extension;
                //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                $foto->move(storage_path('app/public/empresas/'. $empresa->id. '/revisiones_periodicas_entidad/'. $revision_periodica_entidad->id) .'/', $fileName);
                $images[] =  storage_path('app/public/empresas/'. $empresa->id. '/revisiones_periodicas_entidad/'. $revision_periodica_entidad->id) . '/'. $fileName;
            }

            //dd($images);

            $pdf= new Imagick($images);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/revisiones_periodicas_entidad/'. $revision_periodica_entidad->id) .'/'.$filePdfName,true);
            $pdf->clear();
            $pdf->destroy();

            File::delete($images);

            $revision_periodica_entidad->foto = $filePdfName;
            $revision_periodica_entidad->save();
        }

        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'fail' => false,
                'text' => 'La documentacion fue creada exitosamente..!',
                'redirect_url' => route('empresa.revisiones.index', ['id' => $empresa->id, 'name' => $empresa->nombre] )
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
         $roles = Role::get();
         $tipo_tareas = TipoTarea::get();

         $revision_entidad = RevisionPeriodicaEntidad::findOrFail($id);


         return view('empresa.revision-periodica-entidad._form', compact('revision_entidad', 'empresa','roles', 'tipo_tareas'));
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
        $revision_periodica_entidad = RevisionPeriodicaEntidad::findOrFail($id);
        $revision_periodica_entidad->fill($request->except('_token', 'foto'))->update();

        if ($request->has('foto')) {
            $fotos = $request->file('foto');
            foreach($fotos as $i=> $foto){
                $extension = strtolower($foto->getClientOriginalExtension());
                $filePath      = $foto->getRealPath();
                $fileName = uniqid().'.'.$extension;
                //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                $foto->move(storage_path('app/public/empresas/'. $empresa->id. '/revisiones_periodicas_entidad/'. $revision_periodica_entidad->id) .'/', $fileName);
                $images[] =  storage_path('app/public/empresas/'. $empresa->id. '/revisiones_periodicas_entidad/'. $revision_periodica_entidad->id) . '/'. $fileName;
            }

            //dd($images);

            $pdf= new Imagick($images);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/revisiones_periodicas_entidad/'. $revision_periodica_entidad->id) .'/'.$filePdfName,true);
            $pdf->clear();
            $pdf->destroy();

            File::delete($images);

            $revision_periodica_entidad->foto = $filePdfName;
            $revision_periodica_entidad->save();
        }

        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'fail' => false,
                'text' => 'La documentacion fue creada exitosamente..!',
                'redirect_url' => route('empresa.revisiones.index', ['id' => $empresa->id, 'name' => $empresa->nombre] )
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
        $revision_entidad = RevisionPeriodicaEntidad::findOrFail($id);


        if( $revision_entidad->delete() ) {
            $response = [
                'id'        =>  $revision_entidad->id,
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
