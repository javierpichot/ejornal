<?php

namespace App\Http\Controllers\Backend;

use App\Models\Empresa;
use App\Models\Localidad;
use App\Models\Profesional;
use App\Models\ProfesionalTipo;
use App\User;
use App\Models\ObraSocial;

use App\Traits\CheckEmpresaTrait;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use OwenIt\Auditing\Models\Audit;
use Yajra\DataTables\Facades\DataTables;

class ProfesionalController extends Controller
{
    use CheckEmpresaTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesionales = Profesional::with(['profesional_tipo','users'])->get();
        $tipo_profesional = ProfesionalTipo::get();
        return view('backend.profesional.index', compact('profesionales', 'tipo_profesional'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_profesional = ProfesionalTipo::get();
        $users = User::get();
        $obra_social = ObraSocial::get();
        $localidades = Localidad::get();
        return view('backend.profesional.create', compact('tipo_profesional', 'users', 'obra_social', 'localidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'nombre' => 'required|string|max:191',
            'apellido' => 'required|string|max:191'
        );

        // CHECK FORM VALIDATION
        $validator = $this->validate($request, $rules);

        if (Session::token() !== Input::get('_token')) {
            return response()->json(array(
               'msg' => 'Unauthorized attempt to create option'
           ))->setStatusCode(403);
        }

        $profesional = Profesional::create($request->except('_token'));

        $photo = $request->file('photo');
        if (!is_null($photo)) {
            $extension = strtolower(Input::file('photo')->getClientOriginalExtension());
            $filePath      = $photo->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $photo->move(storage_path('app/public/profesionales/'. $profesional->id) .'/perfil/', $fileName);
            $profesional->photo = $fileName;
            $profesional->update();
        }

        $foto_documento = $request->file('foto_documento');
        if (!is_null($foto_documento)) {
            $extension = strtolower(Input::file('foto_documento')->getClientOriginalExtension());
            $filePath      = $foto_documento->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $foto_documento->move(storage_path('app/public/profesionales/'. $profesional->id) .'/documento/', $fileName);
            $profesional->foto_documento = $fileName;
            $profesional->update();
        }

        $foto_matricula = $request->file('foto_matricula');
        if (!is_null($foto_matricula)) {
            $extension = strtolower(Input::file('foto_matricula')->getClientOriginalExtension());
            $filePath      = $foto_matricula->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $foto_matricula->move(storage_path('app/public/profesionales/'. $profesional->id) .'/matricula/', $fileName);
            $profesional->foto_matricula = $fileName;
            $profesional->update();
        }

        $foto_titulo = $request->file('foto_titulo');
        if (!is_null($foto_titulo)) {
            $extension = strtolower(Input::file('foto_titulo')->getClientOriginalExtension());
            $filePath      = $foto_titulo->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $foto_titulo->move(storage_path('/profesionales/'. $profesional->id) .'/titulo/', $fileName);
            $profesional->foto_titulo = $fileName;
            $profesional->update();
        }

        $foto_seguro = $request->file('foto_seguro');
        if (!is_null($foto_seguro)) {
            $extension = strtolower(Input::file('foto_seguro')->getClientOriginalExtension());
            $filePath      = $foto_seguro->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $foto_seguro->move(storage_path('/profesionales/'. $profesional->id) .'/poliza/', $fileName);
            $profesional->foto_seguro = $fileName;
            $profesional->update();
        }

        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.profesional.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profesional = Profesional::findOrFail($id);
        $users = User::get();
        $obra_social = ObraSocial::get();
        $localidades = Localidad::get();
        $tipo_profesional = ProfesionalTipo::get();
        return view('backend.profesional.show', compact('profesional', 'users', 'obra_social', 'localidades', 'tipo_profesional'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_profesional)
    {
        $profesional = Profesional::findOrFail($id_profesional);
        $tipo_profesional = ProfesionalTipo::get();
        $users = User::get();
        $obra_social = ObraSocial::get();
        $localidades = Localidad::get();
        return view('backend.profesional.edit', compact('profesional', 'tipo_profesional', 'users', 'obra_social', 'localidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'nombre' => 'required|string|max:191',
            'apellido' => 'required|string|max:191'
        );

        // CHECK FORM VALIDATION
        $validator = $this->validate($request, $rules);

        if (Session::token() !== Input::get('_token')) {
            return response()->json(array(
               'msg' => 'Unauthorized attempt to create option'
           ))->setStatusCode(403);
        }

        $profesional = Profesional::findOrFail($id);
        $profesional->fill($request->except('_token'))->update();

        $photo = $request->file('photo');
        if (!is_null($photo)) {
            $extension = strtolower(Input::file('photo')->getClientOriginalExtension());
            $filePath      = $photo->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $photo->move(storage_path('app/public/profesionales/'. $profesional->id) .'/perfil/', $fileName);
            $profesional->photo = $fileName;
            $profesional->update();
        }

        $foto_documento = $request->file('foto_documento');
        if (!is_null($foto_documento)) {
            $extension = strtolower(Input::file('foto_documento')->getClientOriginalExtension());
            $filePath      = $foto_documento->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $foto_documento->move(storage_path('app/public/profesionales/'. $profesional->id) .'/documento/', $fileName);
            $profesional->foto_documento = $fileName;
            $profesional->update();
        }

        $foto_matricula = $request->file('foto_matricula');
        if (!is_null($foto_matricula)) {
            $extension = strtolower(Input::file('foto_matricula')->getClientOriginalExtension());
            $filePath      = $foto_matricula->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $foto_matricula->move(storage_path('app/public/profesionales/'. $profesional->id) .'/matricula/', $fileName);
            $profesional->foto_matricula = $fileName;
            $profesional->update();
        }

        $foto_titulo = $request->file('foto_titulo');
        if (!is_null($foto_titulo)) {
            $extension = strtolower(Input::file('foto_titulo')->getClientOriginalExtension());
            $filePath      = $foto_titulo->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $foto_titulo->move(storage_path('/profesionales/'. $profesional->id) .'/titulo/', $fileName);
            $profesional->foto_titulo = $fileName;
            $profesional->update();
        }

        $foto_seguro = $request->file('foto_seguro');
        if (!is_null($foto_seguro)) {
            $extension = strtolower(Input::file('foto_seguro')->getClientOriginalExtension());
            $filePath      = $foto_seguro->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $foto_seguro->move(storage_path('/profesionales/'. $profesional->id) .'/poliza/', $fileName);
            $profesional->foto_seguro = $fileName;
            $profesional->update();
        }

        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.profesional.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profesional = Profesional::findOrFail($id);

        if ($profesional->delete()) {
            $response = [
                'id'        =>  $profesional->id,
                'status'    =>  'success',
                'message'   =>  'El profesional ha sido eliminado',
            ];
        } else {
            $response = [
                'status'    =>  'error',
                'message'   =>  'Intentelo nuevamente'
            ];
        }

        if (\request()->ajax()) {
            return new JsonResponse($response);
        } else {
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function movimientos()
    {
        return view('backend.profesional.movimientos');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getMovimientos()
    {
        $actividades = Audit::orderBy('created_at', 'desc')->get();

        return DataTables::of($actividades)
            ->addColumn('created_at', function ($actividades) {
                return $actividades->created_at;
            })
            ->addColumn('usuario', function ($actividades) {
                return $actividades->user->nombre ."-". $actividades->user->apellido;
            })
            ->addColumn('tipo', function ($actividades) {
                return json_encode($actividades->event);
            })
            ->addColumn('navegador', function ($actividades) {
                return json_encode($actividades->user_agent);
            })
            ->addColumn('auditable_type', function ($actividades) {
                return $actividades->auditable_type;
            })
            ->addColumn('parametros_created', function ($actividades) {
                return json_encode($actividades->new_values);
            })
            ->addColumn('parametros_updated', function ($actividades) {
                return json_encode($actividades->old_values);
            })
            ->addColumn('ip', function ($actividades) {
                return json_encode($actividades->ip_address);
            })
            ->make(true);
    }
}
