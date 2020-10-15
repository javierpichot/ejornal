<?php

namespace App\Http\Controllers\Backend;


use App\Models\Profesional;
use App\Models\ProfesionalFichada;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Session;

class ProfesionalFichadaController extends Controller

{
    public function index()
    {
        $profesional_fichadas = ProfesionalFichada::with(['users', 'profesional', 'empresa'])->orderBy('id', 'desc')->get();
        return view('backend.profesional_fichada.index', compact('profesional_fichadas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Comprueba que ese usuario ya tuvo una entradaif
        $ultimo_registro = ProfesionalFichada::where('profesional_id', auth()->user()->profesional->id)->where('fechahora_salida', null)->first();
        if (!isset($ultimo_registro)) {
            //Entrada
            $profesional_fichada = new ProfesionalFichada;
            $profesional_fichada->empresa_id = 1;
            $profesional_fichada->profesional_id = auth()->user()->profesional->id;
            $profesional_fichada->fechahora_entrada = Carbon::now();
            $profesional_fichada->navegador_entrada = $request->header('User-Agent');
            $profesional_fichada->IP_entrada = $request->ip();
            $profesional_fichada->save();
        } else {
            //Salida
            $profesional_fichada = ProfesionalFichada::where('profesional_id', auth()->user()->profesional->id)->where('fechahora_salida', null)->first();
            $profesional_fichada->fechahora_salida = Carbon::now();
            $profesional_fichada->navegador_salida = $request->header('User-Agent');
            $profesional_fichada->IP_salida = $request->ip();
            $profesional_fichada->save();

        }
        Session::flash('alert', 'Se ha fichado correctamente.');

    }
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getEntradas(Request $request)
    {

        $profesional = Profesional::find(auth()->user()->profesional->id);

        $geo = unserialize(file_get_contents("http://ip-api.com/php/" . $request->ip()));
        $profesional_fichada = $profesional->profesiona_fichada()->create([
            'empresa_id' => $request->post('empresa_id'),
            'fechahora_entrada' => Carbon::now(),
            'localizacion_entrada' => isset($geo["city"]) ? $geo["city"] : null,
            'navegador_entrada' => $request->header('User-Agent'),
            'IP_entrada' => $request->ip()
        ]);

        return response()->json([
            'success' => true,
            'text' => 'Se ha fichado correctamente.',
            'info' => $profesional_fichada->fresh()
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getSalidas(Request $request)
    {
        $profesional_fichada = ProfesionalFichada::where('profesional_id', auth()->user()->profesional->id)->whereNull('fechahora_salida')->firstOrFail();
        $profesional_fichada->fechahora_salida = Carbon::now();
        $nombreloc = "http://ip-api.com/php/" . $request->ip();
        $geo = unserialize(file_get_contents("http://ip-api.com/php/" . $request->ip()));
        $profesional_fichada->localizacion_salida =  isset($geo["city"]) ? $geo["city"] : null;
        $profesional_fichada->navegador_salida = $request->header('User-Agent');
        $profesional_fichada->IP_salida = $request->ip();
        $profesional_fichada->save();

        return response()->json([
            'success' => true,
            'text' => 'Se ha fichado correctamente.',
            'info' => ['hora_salida' => $profesional_fichada->fechahora_salida->format('d-m-Y h:i:s A')]
        ]);
    }


}
