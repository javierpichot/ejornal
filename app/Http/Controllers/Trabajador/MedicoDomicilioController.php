<?php

namespace App\Http\Controllers\Trabajador;

use Imagick;

use App\Models\Trabajador;
use App\Models\PrestacionPedido;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\File;

/**
 * Class MedicoDomicilioController
 * @package App\Http\Controllers\Trabajador
 */
class MedicoDomicilioController extends Controller
{
    /**
     * @param $trabajador_id
     * @param $prestacion_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($trabajador_id, $prestacion_id)
    {
      $trabajador = Trabajador::findOrFail($trabajador_id);
      $prestacion = PrestacionPedido::findOrFail($prestacion_id);

      return view('trabajador.medico_domicilio.medico_domicilio', compact('trabajador', 'prestacion'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \ImagickException
     */
    public function sendInfoReportService(Request $request, $id)
    {
      $prestacion_pedido = PrestacionPedido::findOrFail($request->input('prestacion_id'));
      $trabajador = Trabajador::findOrFail($request->input('trabajador_id'));

      $prestacion_pedido->reporte = $request->input('reporte');
      $prestacion_pedido->feedback = $request->input('feedback');

      if ($request->has('reporte_url')) {
          $documentos = $request->file('reporte_url');
          foreach($documentos as $i=> $documento){
              $extension = strtolower($documento->getClientOriginalExtension());
              $filePath      = $documento->getRealPath();
              $fileName = uniqid().'.'.$extension;
              //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
              $documento->move(storage_path('app/public/empresas/'. $trabajador->empresa_id. '/prestaciones/'. $prestacion_pedido->id) .'/reporte_servicio/', $fileName);
              $images[] =  storage_path('app/public/empresas/'. $trabajador->empresa_id. '/prestaciones/'. $prestacion_pedido->id) .'/reporte_servicio/'. $fileName;
          }

          //dd($images);

          $pdf= new Imagick($images);
          $pdf->setImageFormat('pdf');
          $filePdfName = uniqid().'.pdf';
          $pdf->writeImages(storage_path('app/public/empresas/'. $trabajador->empresa_id. '/prestaciones/'. $prestacion_pedido->id.'/reporte_servicio/') .$filePdfName,true);
          $pdf->clear();
          $pdf->destroy();

          File::delete($images);


          $prestacion_pedido->reporte_url = $filePdfName;
          $prestacion_pedido->estado = 6;
          $prestacion_pedido->save();
      }

      return redirect()->route('home');
    }
}
