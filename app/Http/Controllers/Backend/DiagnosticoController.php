<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 1/27/2019
 * Time: 1:39 p.m.
 */

namespace App\Http\Controllers\Backend;

use Imagick;
use App\Http\Controllers\Controller;
use App\Models\ConsultaMotivo;
use App\Models\Diagnostico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class DiagnosticoController extends Controller
{
    public function index()
    {
        $diagnosticos = Diagnostico::all();
        return view('backend.diagnostico.index', compact('diagnosticos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $motivo_consultas = ConsultaMotivo::all();
        return view('backend.diagnostico.create', compact('motivo_consultas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'diagnostico' => 'required'
        ]);

        $diagnostico = Diagnostico::create($request->except('_token', 'guia'));

        if ($request->has('guia')) {
            $documento = $request->file('guia');
            $extension = strtolower($documento->getClientOriginalExtension());
            $filePath      = $documento->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $documento->move(storage_path('app/public/jornal/guia/'. $diagnostico->id) .'/', $fileName);
            $pdf = storage_path('app/public/jornal/guia/'. $diagnostico->id). '/'. $fileName;
            $diagnostico->guia = $pdf;
            $diagnostico->save();
        }
        if ($request->has('cuidados')) {
            $documento = $request->file('cuidados');
            $extension = strtolower($documento->getClientOriginalExtension());
            $filePath      = $documento->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $documento->move(storage_path('app/public/jornal/cuidados/'. $diagnostico->id) .'/', $fileName);
            $pdf = storage_path('app/public/jornal/cuidados/'. $diagnostico->id). '/'. $fileName;
            $diagnostico->cuidados = $pdf;
            $diagnostico->save();
        }
        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.diagnostico.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ConsultaTipo  $consultaTipo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $motivo_consultas = ConsultaMotivo::all();
        $diagnostico = Diagnostico::findOrFail($id);
        return view('backend.diagnostico.edit', compact('diagnostico', 'motivo_consultas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConsultaTipo  $consultaTipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'diagnostico' => 'required',
            'guia.*' => 'required|mimetypes:image/png,image/jpeg,image/gif'
        ]);

        $diagnostico = Diagnostico::findOrFail($id);

        $diagnostico->fill($request->except('_token', 'guia'))->update();

        if ($request->has('guia')) {
            $documento = $request->file('guia');
            $extension = strtolower($documento->getClientOriginalExtension());
            $filePath      = $documento->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $documento->move(storage_path('app/public/jornal/guia/'. $diagnostico->id) .'/', $fileName);
            $pdf = storage_path('app/public/jornal/guia/'. $diagnostico->id). '/'. $fileName;
            $diagnostico->guia = $pdf;
            $diagnostico->save();
        }

        if ($request->has('cuidados')) {
            $documento = $request->file('cuidados');
            $extension = strtolower($documento->getClientOriginalExtension());
            $filePath      = $documento->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $documento->move(storage_path('app/public/jornal/cuidados/'. $diagnostico->id) .'/', $fileName);
            $pdf = storage_path('app/public/jornal/cuidados/'. $diagnostico->id). '/'. $fileName;
            $diagnostico->cuidados = $pdf;
            $diagnostico->save();
        }
        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.diagnostico.index');
    }
}