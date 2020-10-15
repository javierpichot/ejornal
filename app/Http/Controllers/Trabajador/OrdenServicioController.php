<?php namespace App\Http\Controllers\Trabajador;

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
        $prestacion_orden_servicio = $prestacion_pedido->orden_servicio()->create($request->except('_token', 'orden_servicio_url'));
        if ($request->has('orden_servicio_url')) {
            $documentos = $request->file('orden_servicio_url');

            foreach($documentos as $i => $documento){
                $extension = strtolower($documento->getClientOriginalExtension());
                $filePath      = $documento->getRealPath();
                $fileName = uniqid().'.'.$extension;
                //$files = Storage::putFileAs('public/empresa/'. $empresa->id .'/', new File($filePath), $fileName);
                $documento->move(storage_path('app/public/empresas/'.$prestacion_pedido->empresa->id. '/trabajadores/'. $prestacion_pedido->trabajador->id .'/orden_servicio/' . $prestacion_orden_servicio->id ) .'/', $fileName);
                $images[] =  storage_path('app/public/empresas/'.$prestacion_pedido->empresa->id. '/trabajadores/'. $prestacion_pedido->trabajador->id .'/orden_servicio/' . $prestacion_orden_servicio->id ) . '/'. $fileName;
            }

            $pdf= new Imagick($images);
            $pdf->setImageFormat('pdf');
            $filePdfName = uniqid().'.pdf';
            $pdf->writeImages(storage_path('app/public/empresas/'.$prestacion_pedido->empresa->id. '/trabajadores/'. $prestacion_pedido->trabajador->id .'/orden_servicio/' . $prestacion_orden_servicio->id ) .'/'.$filePdfName,true);
            $pdf->clear();
            $pdf->destroy();

            File::delete($images);

            $prestacion_orden_servicio->orden_servicio_url = $filePdfName;
            $prestacion_orden_servicio->save();
        }
        $prestacion_pedido->estado = 5;
        $prestacion_pedido->save();


        return redirect()->route('trabajador.prestacion.pedido.show', ['id' => $prestacion_pedido->id, 'name' => $prestacion_pedido->trabajador->nombre, 'trabajador_id' => $prestacion_pedido->trabajador->id, 'empresa_id' => $empresa->id]);
    }
}
