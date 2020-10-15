<?php namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\PrestacionPedido;
use App\Models\OrdenServicio;
use App\Traits\CheckEmpresaTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Imagick;

use Spatie\Activitylog\Models\Activity;

class OrdenServicioController extends Controller
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
        $prestacion_orden_servicio = OrdenServicio::create($request->except('_token', 'orden_servicio_url'));

        if ($request->has('orden_servicio_url')) {
            $documentos = $request->file('orden_servicio_url');

            foreach($documentos as $i => $documento){
                $extension = strtolower($documento->getClientOriginalExtension());
                $filePath      = $documento->getRealPath();
                $fileName = uniqid().'.'.$extension;
                //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                $documento->move(storage_path('app/public/empresas/'. $empresa->id. '/prestaciones/'. $prestacion_pedido->id) .'/orden_servicio/', $fileName);
                $images[] =  storage_path('app/public/empresas/'. $empresa->id. '/prestaciones/'. $prestacion_pedido->id) .'/orden_servicio/'. $fileName;
            }

            $pdf= new Imagick($images);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'. $empresa->id. '/prestaciones/'. $prestacion_pedido->id.'/orden_servicio/') .$filePdfName,true);
            $pdf->clear();
            $pdf->destroy();

            File::delete($images);

            $prestacion_orden_servicio->orden_servicio_url = $filePdfName;
            $prestacion_orden_servicio->save();
        }
        $prestacion_pedido->estado = 5;
        $prestacion_pedido->save();


        return redirect()->route('empresa.prestacion.pedido.show', ['id' => $prestacion_pedido->id, 'id_empresa' => $request->input('empresa_id')]);
    }
}
