<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 10/12/18
 * Time: 12:13 PM
 */

namespace App\Http\Controllers;


use App\Models\Ausentismo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

/**
 * Class AusenciaDetallesController
 * @package App\Http\Controllers
 */
class AusenciaDetallesController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        $id = Crypt::decrypt($request->post('id'));
        $ausencia = Ausentismo::with(['trabajador', 'empresa', 'ausentismo_tipo', 'incidencia'])->findOrFail($id);
        $data = $this->_prepare_leave_info($ausencia);


        return view('events.ausencia_details', compact('data'));

    }

    /**
     * @param $empresa_id
     * @param $trabajador
     * @return string
     */
    protected function getFotoTrabajador($empresa_id, $trabajador)
    {
        return isset($trabajador->photo) ?  asset('storage/empresas/'. $empresa_id . '/trabajadores/' . $trabajador->id . '/perfil/'. $trabajador->photo . '') : asset('img/avatar5.png');
    }

    /**
     * @param $data
     * @return mixed
     */
    private function _prepare_leave_info($data) {
        $image_url = $this->getFotoTrabajador($data->empresa_id, $data->trabajador);
        $data->applicant_meta = "<span class='avatar avatar-xs mr10'><img src='$image_url' alt=''></span>";
        $data->dias_ausente = $data->dias_ausente;
        $data->tipo_ausencia = $data->ausentismo_tipo->nombre;
        return $data;
    }

}