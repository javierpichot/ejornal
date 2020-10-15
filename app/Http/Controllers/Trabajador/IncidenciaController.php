<?php

namespace App\Http\Controllers\Trabajador;

use Imagick;

use App\Models\Empresa;
use App\Models\Consulta;
use App\Models\Incidencia;
use App\Models\TipoLesion;
use App\Models\Trabajador;
use App\Models\FormaAccidente;
use App\Models\TipoIncidencia;
use App\Models\UbicacionLesion;

use App\Traits\CheckEmpresaTrait;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use Spatie\Activitylog\Models\Activity;

class IncidenciaController extends Controller
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
         $this->checkEmpresa($request->input('empresa_id'));
         $empresa = Empresa::findOrFail($request->input('empresa_id'));
         $trabajador = Trabajador::findOrFail($request->input('trabajador_id'));

         $incidencia = $trabajador->incidencia()->create($request->except('_token', 'trabajador_id', 'fotos_lesion', 'fotos_accidente', 'fotos_escenario'));

         if ($request->has('fotos_lesion')) {
             $fotos_lesions = $request->file('fotos_lesion');
             foreach($fotos_lesions as $i=> $lesion){
                 $extension = strtolower($lesion->getClientOriginalExtension());
                 $filePath      = $lesion->getRealPath();
                 $fileName = uniqid().'.'.$extension;
                 //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                 //$lesion->move(storage_path('/trabajadores/'. $trabajador->id) .'/', $fileName);
                 $lesion->move(storage_path('app/public/empresas/'. $empresa->id. '/trabajadores/'. $trabajador->id . '/seh/'. $incidencia->id) .'/', $fileName);
                 $lesion_multi[] =  storage_path('app/public/empresas/'. $empresa->id. '/trabajadores/'. $trabajador->id . '/seh/'. $incidencia->id) . '/'. $fileName;
             }

             //dd($images);

             $pdf= new Imagick($lesion_multi);
             $pdf->setImageFormat('pdf');
             $filePdfName = uniqid().'.pdf';
             $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/trabajadores/'. $trabajador->id . '/seh/'. $incidencia->id) .'/'.$filePdfName,true);
             $pdf->clear();
             $pdf->destroy();

             File::delete($lesion_multi);

             $incidencia->fotos_lesion = $filePdfName;
             $incidencia->update();
         }

         if ($request->has('fotos_accidente')) {
             $fotos_accidente = $request->file('fotos_accidente');
             foreach($fotos_accidente as $i=> $accidente){
                 $extension = strtolower($accidente->getClientOriginalExtension());
                 $filePath      = $accidente->getRealPath();
                 $fileName = uniqid().'.'.$extension;
                 //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                 $accidente->move(storage_path('app/public/empresas/'. $empresa->id. '/trabajadores/'. $trabajador->id . '/seh/'. $incidencia->id) .'/', $fileName);
                 $accidentes_multi[] =  storage_path('app/public/empresas/'. $empresa->id. '/trabajadores/'. $trabajador->id . '/seh/'. $incidencia->id) . '/'. $fileName;
             }

             //dd($images);

             $pdf = new Imagick($accidentes_multi);
             $pdf->setImageFormat('pdf');
             $filePdfName = uniqid().'.pdf';
             $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/trabajadores/'. $trabajador->id . '/seh/'. $incidencia->id) .'/'.$filePdfName,true);
             $pdf->clear();
             $pdf->destroy();

             File::delete($accidentes_multi);

             $incidencia->fotos_accidente = $filePdfName;
             $incidencia->update();
         }

         if ($request->has('fotos_escenario')) {
             $fotos_escenario = $request->file('fotos_escenario');
             foreach($fotos_escenario as $i=> $escenario){
                 $extension = strtolower($escenario->getClientOriginalExtension());
                 $filePath      = $escenario->getRealPath();
                 $fileName = uniqid().'.'.$extension;
                 //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                 $escenario->move(storage_path('app/public/empresas/'. $empresa->id. '/trabajadores/'. $trabajador->id . '/seh/'. $incidencia->id) .'/', $fileName);
                 $escenarios_multi[] =  storage_path('app/public/empresas/'. $empresa->id. '/trabajadores/'. $trabajador->id . '/seh/'. $incidencia->id).'/'. $fileName;
             }

             //dd($images);

             $pdf= new Imagick($escenarios_multi);
             $pdf->setImageFormat('pdf');
             $filePdfName = uniqid().'.pdf';
             $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/trabajadores/'. $trabajador->id . '/seh/'. $incidencia->id) .'/'.$filePdfName,true);
             $pdf->clear();
             $pdf->destroy();

             File::delete($escenarios_multi);

             $incidencia->fotos_escenario = $filePdfName;
             $incidencia->update();
         }
         if ($request->isMethod('get')){

         } else {

             return response()->json([
                 'fail' => false,
                 'text' => 'La incidencia fue creada exitosamente..!',
                 'redirect_url' => route('trabajador.incidencia.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id] )
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

         $trabajador = Trabajador::with(['incidencia.trabajador', 'incidencia.user'])->findOrFail($id);
         //$tipo_incidencia = TipoIncidencia::get();
         $consultas = Consulta::where('trabajador_id', $trabajador->id)->get();
         $forma_accidentes = FormaAccidente::get();
         $tipo_lesions = TipoLesion::get();
         $ubicacion_lesions = UbicacionLesion::get();
         $tipo_incidencias = TipoIncidencia::get();

         return view('trabajador.incidencia.show', compact('trabajador', 'empresa', 'consultas', 'forma_accidentes', 'ubicacion_lesions', 'tipo_lesions', 'tipo_incidencias'));
     }


     public function view($incidencia_id,$trabajador_id, $empresa_id)
     {
         $this->checkEmpresa($empresa_id);
         $empresa = Empresa::findOrFail($empresa_id);
         $incidencia = Incidencia::findOrFail($incidencia_id);
         $trabajador = Trabajador::findOrFail($trabajador_id);
         $consultas = Consulta::get();
         $forma_accidentes = FormaAccidente::get();
         $tipo_lesions = TipoLesion::get();
         $ubicacion_lesions = UbicacionLesion::get();
         $tipo_incidencias = TipoIncidencia::get();


         return view('trabajador.incidencia.view', compact('empresa', 'consultas', 'forma_accidentes', 'tipo_lesions', 'ubicacion_lesions', 'tipo_incidencias', 'incidencia', 'trabajador'));
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

        $forma_accidentes = FormaAccidente::get();
        $tipo_lesions = TipoLesion::get();
        $ubicacion_lesions = UbicacionLesion::get();
        $tipo_incidencias = TipoIncidencia::get();

        $incidencia = Incidencia::findOrFail($id);

        $consultas = Consulta::where('trabajador_id', $trabajador->id)->get();

        return view('trabajador.incidencia._form', compact('incidencia','consultas', 'forma_accidentes', 'tipo_lesions', 'ubicacion_lesions', 'tipo_incidencias', 'incidencia', 'trabajador'));
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
        $trabajador = Trabajador::find($request->input('trabajador_id'));

        $incidencia = Incidencia::findOrFail($id);
        $incidencia->fill($request->except('_method', '_token'))->update();

        if ($request->has('fotos_lesion')) {
            $fotos_lesions = $request->file('fotos_lesion');
            foreach($fotos_lesions as $i=> $lesion){
                $extension = strtolower($lesion->getClientOriginalExtension());
                $filePath      = $lesion->getRealPath();
                $fileName = uniqid().'.'.$extension;
                //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                $lesion->move(storage_path('/trabajadores/'. $trabajador->id) .'/', $fileName);
                $images[] =  storage_path().'/trabajadores/'. $trabajador->id . '/'. $fileName;
            }

            //dd($images);

            $pdf= new Imagick($images);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path().'/trabajadores/'. $trabajador->id .'/'.$filePdfName,true);
            $pdf->clear();
            $pdf->destroy();

            File::delete($images);

            $incidencia->fotos_lesion = $filePdfName;
            $incidencia->update();
        }

        if ($request->has('fotos_accidente')) {
            $fotos_accidente = $request->file('fotos_accidente');
            foreach($fotos_accidente as $i=> $accidente){
                $extension = strtolower($accidente->getClientOriginalExtension());
                $filePath      = $accidente->getRealPath();
                $fileName = uniqid().'.'.$extension;
                //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                $accidente->move(storage_path('/trabajadores/'. $trabajador->id) .'/', $fileName);
                $images[] =  storage_path().'/trabajadores/'. $trabajador->id . '/'. $fileName;
            }

            //dd($images);

            $pdf= new Imagick($images);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path().'/trabajadores/'. $trabajador->id .'/'.$filePdfName,true);
            $pdf->clear();
            $pdf->destroy();

            File::delete($images);

            $incidencia->fotos_accidente = $filePdfName;
            $incidencia->update();
        }

        if ($request->has('fotos_escenario')) {
            $fotos_escenario = $request->file('fotos_escenario');
            foreach($fotos_escenario as $i=> $escenario){
                $extension = strtolower($escenario->getClientOriginalExtension());
                $filePath      = $escenario->getRealPath();
                $fileName = uniqid().'.'.$extension;
                //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                $escenario->move(storage_path('/trabajadores/'. $trabajador->id) .'/', $fileName);
                $images[] =  storage_path().'/trabajadores/'. $trabajador->id . '/'. $fileName;
            }

            //dd($images);

            $pdf= new Imagick($images);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path().'/trabajadores/'. $trabajador->id .'/'.$filePdfName,true);
            $pdf->clear();
            $pdf->destroy();

            File::delete($images);

            $incidencia->fotos_escenario = $filePdfName;
            $incidencia->update();
        }
        if ($request->isMethod('get')){

        } else {

            return response()->json([
                'fail' => false,
                'text' => 'La incidencia fue editada exitosamente..!',
                'redirect_url' => route('trabajador.incidencia.show', ['id' => $trabajador->id, 'name' => $trabajador->nombre, 'empresa_id' => $empresa->id] )
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
         $incidencia = Incidencia::findOrFail($id);
         if( $incidencia->delete() ) {
             $response = [
                 'id'        =>  $incidencia->id,
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
