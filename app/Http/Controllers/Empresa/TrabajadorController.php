<?php

namespace App\Http\Controllers\Empresa;

use App\Models\Tarea;
use App\Models\Turno;
use App\Models\Sector;
use App\Models\Empresa;
use App\Models\Localidad;
use App\Models\Enfermedad;
use App\Models\EstiloVida;
use App\Models\ObraSocial;
use App\Models\Trabajador;
use App\Models\Antecedente;
use App\Models\AntecedenteFamilar;

use App\Traits\BuckeTrait;
use App\Traits\CheckEmpresaTrait;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use Spatie\Activitylog\Models\Activity;

class TrabajadorController extends Controller
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
        // FORM VALIDATION RULES
        $rules = array(
            'nombre' => 'required|string|max:191',
            'apellido' => 'required|string|max:191',
            'documento' => 'required|string|max:12|unique:trabajadors,documento',
            'fecha_nacimiento' => 'nullable|date',
            'numero_afiliado' => 'nullable|numeric',
            'celular' => 'nullable|string|max:24',
            'telefono' => 'nullable|string|max:24',
            'direccion' => 'nullable|string|max:1000',
            'localidad' => 'nullable|string|max:191',
            'email' => 'nullable|email',
            'photo' => [
                'mimes:jpeg,bmp,png',
                'max:10000'
            ],
            'observacion_direccion' => 'nullable|string|max:1000',
            'fecha_contrato' => 'nullable|date',
            'empresa_id' => 'sometimes|nullable|exists:empresas,id',
            'obra_social_id' => 'sometimes|nullable|exists:obra_socials,id',
            'localidad_id' => 'sometimes|nullable|exists:localidads,id',
            'numero_legajo' => 'nullable|numeric',
            'sector_id' => 'sometimes|nullable|exists:sectors,id',
            'tarea_id' => 'sometimes|nullable|exists:tareas,id',
            'turno_id' => 'sometimes|nullable|exists:turnos,id'
        );

        // CHECK FORM VALIDATION
        $validator = $this->validate($request,$rules);

        if ( Session::token() !== Input::get( '_token' ) ) {
           return response()->json( array(
               'msg' => 'Unauthorized attempt to create option'
           ) )->setStatusCode(403);
       }

        $trabajador = Trabajador::create($request->except('_token', 'antecedente_medico_id', 'antecedente_familiar_id', 'estilo_vida_id', 'nombre_familiar', 'numero', 'carga_familiar', 'photo'));

        $trabajador->familiar()->create([
            'nombre_familiar' => $request->get('nombre_familiar'),
            'celular_familiar' => $request->get('celular_familiar'),
            'carga_familiar' => $request->get('carga_familiar') ,
        ]);
        if ($request->has('antecedente_medico_id')) {
            foreach ($request->input('antecedente_medico_id') as $key => $value) {
                $trabajador->antecedente_medico()->create([
                    'enfermedad_id' => $value
                ]);
            }
        }
        if ($request->has('antecedente_familiar_id')) {
            foreach ($request->input('antecedente_familiar_id') as $key => $value) {
                $trabajador->antecedente_familiar()->create([
                    'enfermedad_id' => $value
                ]);
            }
        }
        if ($request->has('estilo_vida_id')) {
            foreach ($request->input('estilo_vida_id') as $key => $value) {
                $trabajador->estilo_vida()->create([
                    'enfermedad_id' => $value
                ]);
            }
        }

        $photo = $request->file('photo');
        if(!is_null($photo)) {
            $extension = strtolower(Input::file('photo')->getClientOriginalExtension());
            $filePath      = $photo->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $photo->move(storage_path('app/public/empresas/'. $empresa->id. '/trabajadores/'. $trabajador->id) .'/perfil/', $fileName);
            $trabajador->photo = $fileName;
            $trabajador->update();
        }
        $response = array(
            'status' => 'success',
            'msg' => 'created successfully',
        );

        return response()->json( $response );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $id_empresa)
    {
        $this->checkEmpresa($id_empresa);

        $empresa = Empresa::findOrFail($id_empresa);

        $trabajador = Trabajador::with(['antecedente_medico', 'antecedente_familiar', 'estilo_vida', 'familiar'])->findOrFail($id);
        $obra_social = ObraSocial::get();
        $localidades = Localidad::get();
        $sectores = Sector::where('empresa_id', $id_empresa)->get();
        $tareas = Tarea::where('empresa_id', $id_empresa)->get();
        $turnos = Turno::where('empresa_id', $id_empresa)->get();
        $enfermedades = Enfermedad::get();
        $filter_enfermedades = collect($enfermedades);

        $antecedentes_medico = $filter_enfermedades->filter(function ($value, $key) {
            return $value->tipo == 1;
        });

        $antecedentes_familiar = $filter_enfermedades->filter(function ($value, $key) {
            return $value->tipo == 3;
        });

        $estilo_vida = $filter_enfermedades->filter(function ($value, $key) {
            return $value->tipo == 2;
        });

        return view('empresa.trabajador._form', compact('empresa', 'trabajador', 'obra_social', 'localidades', 'sectores', 'tareas', 'turnos', 'antecedentes_medico', 'antecedentes_familiar', 'estilo_vida'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $id_empresa)
    {
        $this->checkEmpresa($id_empresa);
        $empresa = Empresa::findOrFail($id_empresa);
        $trabajador = Trabajador::findOrFail($id);

        $this->validate($request, [
            'nombre' => 'required|string|max:191',
            'apellido' => 'required|string|max:191',
            'documento' => 'sometimes|required|string|max:12|unique:trabajadors,documento,' . $trabajador->id,
            'fecha_nacimiento' => 'nullable|date',
            'numero_afiliado' => 'nullable|numeric',
            'celular' => 'nullable|string|max:24',
            'telefono' => 'nullable|string|max:24',
            'direccion' => 'nullable|string|max:1000',
            'localidad' => 'nullable|string|max:191',
            'email' => 'nullable|email',
            'photo' => [
                'mimes:jpeg,bmp,png',
                'max:10000'
            ],
            'observacion_direccion' => 'nullable|string|max:1000',
            'fecha_contrato' => 'nullable|date',
            'empresa_id' => 'sometimes|exists:empresas,id',
            'obra_social_id' => 'sometimes|nullable|exists:obra_socials,id',
            'localidad_id' => 'sometimes|nullable|exists:localidads,id',
            'numero_legajo' => 'nullable|numeric',
            'sector_id' => 'sometimes|nullable|exists:sectors,id',
            'tarea_id' => 'sometimes|nullable|exists:tareas,id',
            'turno_id' => 'sometimes|nullable|exists:turnos,id'
        ]);

        $trabajador->fill($request->except('_token', 'antecedente_medico_id', 'antecedente_familiar_id', 'estilo_vida_id', 'nombre_familiar', 'numero', 'carga_familiar'))->update();

        $trabajador->familiar()->updateOrCreate([
            'nombre_familiar' => $request->get('nombre_familiar'),
            'celular_familiar' => $request->get('celular_familiar'),
            'carga_familiar' => $request->get('carga_familiar'),
        ]);

        /*
        Save hasMany
         */
        if ($request->has('antecedente_medico_id')) {
            foreach ($request->input('antecedente_medico_id') as $key => $value) {
                $antecedente = new Antecedente();
                $antecedente->enfermedad_id = $value;
                $trabajador->antecedente_medico()->save($antecedente);
            }
        }

        if ($request->has('antecedente_familiar_id')) {
            foreach ($request->input('antecedente_familiar_id') as $key => $value) {
                $antecedente = new AntecedenteFamilar();
                $antecedente->enfermedad_id = $value;
                $trabajador->antecedente_familiar()->save($antecedente);
            }
        }

        if ($request->has('estilo_vida_id')) {
            foreach ($request->input('estilo_vida_id') as $key => $value) {
                $antecedente = new EstiloVida();
                $antecedente->enfermedad_id = $value;
                $trabajador->estilo_vida()->save($antecedente);
            }
        }

        $photo = $request->file('photo');

        if(!is_null($photo)) {
            $extension = strtolower(Input::file('photo')->getClientOriginalExtension());
            $filePath      = $photo->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $photo->move(storage_path('app/public/empresas/'. $empresa->id. '/trabajadores/'. $trabajador->id) .'/perfil/', $fileName);
            $trabajador->photo = $fileName;
            $trabajador->update();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->checkEmpresa(request()->input('empresa_id'));
        $trabajador = Trabajador::findOrFail($id);


        if(  $trabajador->delete() ) {
            $response = [
                'id'        =>  $trabajador->id,
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
