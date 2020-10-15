<?php

namespace App\Http\Controllers\Backend;

use App\User;

use Caffeinated\Shinobi\Models\Role;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Empresa;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['roles'])->get();

        return view('backend.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $empresas = Empresa::all();
        return view('backend.user.create', compact('roles', 'empresas'));
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
          'password' => 'required|string|min:6|confirmed',
          'username' => 'required|unique:users',
          'email' => 'required|email',
          'telefono' => 'required'
      ]);

        $user = User::create([
          'username' => $request->input('username'),
          'nombre' => $request->input('nombre'),
          'apellido' => $request->input('apellido'),
          'email' => $request->input('email'),
          'empresa_id' => $request->input('empresa_id'),
          'password' => bcrypt($request->input('password')),
          'password_email' => $request->input('password_email'),
          'email_imap' => $request->input('email_imap'),
          'is_empresa' => false
      ]);
        $user->roles()->sync($request->get('roles'));
        $user->empresas()->sync($request->get('empresas'));

        $file = $request->file('photo');

        if (!is_null($file)) {
            $extension = strtolower(Input::file('photo')->getClientOriginalExtension());
            $filePath      = $file->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $file->move(storage_path('app/public/jornal/usuario/'. $user->id) .'/perfil/', $fileName);
            $user->photo = $fileName;
            $user->update();
        }
        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.users.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $roles = Role::get();
        $empresas = Empresa::all();
        return view('backend.user.edit', compact('usuario', 'roles', 'empresas'));
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
        $user = User::findOrFail($id);
        $this->validate($request, [
            'username' => 'required|unique:users,username,'. $user->id,
             'email' => 'required|email',
             'telefono' => 'required'
         ]);
        $password = $request->input('password');
        if (isset($password)) {
            $this->validate($request, [
                 'password' => 'required|string|min:6|confirmed',
             ]);
        }

        $user->username = $request->input('username');
        $user->nombre = $request->input('nombre');
        $user->apellido = $request->input('apellido');
        $user->email = $request->input('email');
        $user->telefono = $request->input('telefono');

        $user->telefono = $request->input('telefono');
        if (isset($password)) {
            $user->password = bcrypt($request->input('password'));
        }
        $password_email = $request->input('password_email');
        if (isset($password_email)) {
            $user->password_email = $request->input('password_email');
        }



        $file = $request->file('photo');
        if (!is_null($file)) {
            $extension = strtolower(Input::file('photo')->getClientOriginalExtension());
            $filePath      = $file->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $file->move(storage_path('app/public/jornal/usuario/'. $user->id) .'/perfil/', $fileName);
            $user->photo = $fileName;
            $user->update();
        }

        $user->save();
        $user->roles()->sync($request->input('roles'));

        $user->empresas()->sync($request->input('empresas'));

        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->delete()) {
            $response = [
                'id'        =>  $user->id,
                'status'    =>  'success',
                'message'   =>  'Registro eliminado',
            ];
        } else {
            $response = [
                'status'    =>  'error',
                'message'   =>  'Intente nuevamente'
            ];
        }

        if (\request()->ajax()) {
            return new JsonResponse($response);
        } else {
        }
    }

    public function movimientos()
    {
        return view('backend.user.movimientos');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getMovimientos()
    {
        $actividades = Audit::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        return DataTables::of($actividades)
            ->addColumn('created_at', function ($actividades) {
                return $actividades->created_at->diffForHumans();
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
