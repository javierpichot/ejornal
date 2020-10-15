<?php

namespace App\Http\Controllers\Empresa;

use Illuminate\Support\Facades\File;
use Imagick;

use App\Http\Controllers\Controller;

use App\Models\Empresa;
use App\Models\Consulta;
use App\Models\Incidencia;
use App\Models\TipoLesion;
use App\Models\FormaAccidente;
use App\Models\TipoIncidencia;
use App\Models\UbicacionLesion;
use App\Traits\CheckEmpresaTrait;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use Spatie\Activitylog\Models\Activity;

class IncidenciaController extends Controller
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
        $empresa = Empresa::with(['incidencia.trabajador', 'incidencia.user', 'incidencia.tipo_incidencia'])->findOrFail($id_empresa);
        $consultas = Consulta::get();
        $forma_accidentes = FormaAccidente::get();
        $tipo_lesions = TipoLesion::get();
        $ubicacion_lesions = UbicacionLesion::get();
        $tipo_incidencias = TipoIncidencia::get();

        return view('empresa.incidencia.index', compact('empresa', 'consultas', 'forma_accidentes', 'tipo_lesions', 'ubicacion_lesions', 'tipo_incidencias'));
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

        $incidencia = Incidencia::create($request->except('_token', 'fotos_lesion', 'fotos_accidente', 'fotos_escenario'));



        if ($request->has('fotos_lesion')) {
            $fotos_lesions = $request->file('fotos_lesion');
            foreach($fotos_lesions as $i=> $lesion){
                $extension = strtolower($lesion->getClientOriginalExtension());
                $filePath      = $lesion->getRealPath();
                $fileName = uniqid().'.'.$extension;
                $lesion->move(storage_path('app/public/empresas/'. $empresa->id.  '/seh/'. $incidencia->id) .'/', $fileName);
                $lesion_multi[] =  storage_path('app/public/empresas/'. $empresa->id. '/seh/'. $incidencia->id) . '/'. $fileName;
            }

            //dd($images);

            $pdf= new Imagick($lesion_multi);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/seh/'. $incidencia->id) .'/'.$filePdfName,true);
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
                $accidente->move(storage_path('app/public/empresas/'. $empresa->id.  '/seh/'. $incidencia->id) .'/', $fileName);
                $accidentes_multi[] =  storage_path('app/public/empresas/'. $empresa->id. '/seh/'. $incidencia->id) . '/'. $fileName;
            }

            //dd($images);

            $pdf = new Imagick($accidentes_multi);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/seh/'. $incidencia->id) .'/'.$filePdfName,true);
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
                $escenario->move(storage_path('app/public/empresas/'. $empresa->id.  '/seh/'. $incidencia->id) .'/', $fileName);
                $escenarios_multi[] =  storage_path('app/public/empresas/'. $empresa->id. '/seh/'. $incidencia->id).'/'. $fileName;

            }

            //dd($images);

            $pdf= new Imagick($escenarios_multi);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/seh/'. $incidencia->id) .'/'.$filePdfName,true);
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
                'redirect_url' => route('empresa.incidencias.index', ['id' => $empresa->id, 'name' => $empresa->nombre] )
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function show($incidencia_id, $empresa_id)
    {
        $this->checkEmpresa($empresa_id);
        $empresa = Empresa::findOrFail($empresa_id);
        $incidencia = Incidencia::findOrFail($incidencia_id);
        $consultas = Consulta::get();
        $forma_accidentes = FormaAccidente::get();
        $tipo_lesions = TipoLesion::get();
        $ubicacion_lesions = UbicacionLesion::get();
        $tipo_incidencias = TipoIncidencia::get();


        return view('empresa.incidencia.show', compact('empresa', 'consultas', 'forma_accidentes', 'tipo_lesions', 'ubicacion_lesions', 'tipo_incidencias', 'incidencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $incidencia_id, $empresa_id)
    {
        $this->checkEmpresa($empresa_id);
        $empresa = Empresa::findOrFail($empresa_id);
        $incidencia = Incidencia::with(['trabajador', 'consulta', 'empresa', 'user'])->findOrFail($incidencia_id);

        $consultas = Consulta::get();
        $forma_accidentes = FormaAccidente::get();
        $tipo_lesions = TipoLesion::get();
        $ubicacion_lesions = UbicacionLesion::get();
        $tipo_incidencias = TipoIncidencia::get();

        return view('empresa.incidencia._form', compact('incidencia', 'empresa', 'forma_accidentes', 'tipo_lesions', 'ubicacion_lesions', 'tipo_incidencias', 'consultas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $incidencia_id, $empresa_id)
    {
        $this->validate($request, [
            'tipo_incidencia_id' => 'required',
            'fecha' => 'required|date',
            'lugar' => 'required',
        ]);
        $this->checkEmpresa($empresa_id);
        $empresa = Empresa::findOrFail($empresa_id);
        $incidencia = Incidencia::findOrFail($incidencia_id);
        $incidencia->fill($request->except('_token', 'fotos_lesion', 'fotos_accidente', 'fotos_escenario'))->update();

        $fotos_lesion = $request->file('fotos_lesion');


        if ($request->has('fotos_lesion')) {
            $fotos_lesions = $request->file('fotos_lesion');
            foreach($fotos_lesions as $i=> $lesion){
                $extension = strtolower($lesion->getClientOriginalExtension());
                $filePath      = $lesion->getRealPath();
                $fileName = uniqid().'.'.$extension;
                $lesion->move(storage_path('app/public/empresas/'. $empresa->id.  '/seh/'. $incidencia->id) .'/', $fileName);
                $lesion_multi[] =  storage_path('app/public/empresas/'. $empresa->id. '/seh/'. $incidencia->id) . '/'. $fileName;
            }

            //dd($images);

            $pdf= new Imagick($lesion_multi);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/seh/'. $incidencia->id) .'/'.$filePdfName,true);
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
                $accidente->move(storage_path('app/public/empresas/'. $empresa->id.  '/seh/'. $incidencia->id) .'/', $fileName);
                $accidentes_multi[] =  storage_path('app/public/empresas/'. $empresa->id. '/seh/'. $incidencia->id) . '/'. $fileName;
            }

            //dd($images);

            $pdf = new Imagick($accidentes_multi);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/seh/'. $incidencia->id) .'/'.$filePdfName,true);
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
                $escenario->move(storage_path('app/public/empresas/'. $empresa->id.  '/seh/'. $incidencia->id) .'/', $fileName);
                $escenarios_multi[] =  storage_path('app/public/empresas/'. $empresa->id. '/seh/'. $incidencia->id).'/'. $fileName;

            }

            //dd($images);

            $pdf= new Imagick($escenarios_multi);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/seh/'. $incidencia->id) .'/'.$filePdfName,true);
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
                'text' => 'La incidencia fue editada exitosamente..!',
                'redirect_url' => route('empresa.incidencias.index', ['id' =>  $empresa->id, 'name' =>  $empresa->nombre] )
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Incidencia  $incidencia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->checkEmpresa(request()->input('empresa_id'));
        $incidencia = Incidencia::findOrFail($id);

        if(  $incidencia->delete() ) {
            $response = [
                'id'        =>  $incidencia->id,
                'status'    =>  'success',
                'message'   =>  'La incidencia a sido eliminada',
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
