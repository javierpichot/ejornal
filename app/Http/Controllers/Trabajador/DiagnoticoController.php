<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 1/24/2019
 * Time: 7:18 a.m.
 */

namespace App\Http\Controllers\Trabajador;


use App\Http\Controllers\Controller;
use App\Models\Diagnostico;
use Illuminate\Http\Request;

/**
 * Class DiagnoticoController
 * @package App\Http\Controllers\Trabajador
 */
class DiagnoticoController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function show(Request $request)
    {
        $diagnosticos = Diagnostico::where('consulta_motivo_id', $request->post('consulta_motivo_id'))->get();

        return response()->json(["success" => true,  'data' => view('trabajador.consulta.load_diagnosticos')->with('diagnosticos',$diagnosticos)->render()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function guia(Request $request)
    {
        $diagnosticos = Diagnostico::findOrFail($request->post('diagnostico_id'));

        return response()->json(["success" => true,  'data' => view('trabajador.consulta.load_guia')->with('diagnosticos',$diagnosticos)->render()]);
    }
}