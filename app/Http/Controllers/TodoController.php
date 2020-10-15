<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 07/01/19
 * Time: 01:58 PM
 */

namespace App\Http\Controllers;


use App\Models\RevisionPeriodica;
use App\Models\RevisionPeriodicaEntidad;
use Illuminate\Http\Request;

/**
 * Class TodoController
 * @package App\Http\Controllers
 */
class TodoController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save_status(Request $request)
    {
        $tarea = RevisionPeriodicaEntidad::find($request->post('id'));

        $tarea->estado = true;

        $tarea->save();

        $data = [
            'revision_periodica_entidad_id' => $tarea->id,
            'revision_periodica_tipo_id' =>  2,
            'informe' => 'Tarea completada',
            'observaciones' => 'Ninguna observacion',
            'user_id' => auth()->user()->id
        ];
        RevisionPeriodica::create($data);

        return response()->json(['success' => true, 'data' => $tarea, 'message' => 'Se ha salvado el registro', 'id' => $tarea->id]);
    }

}