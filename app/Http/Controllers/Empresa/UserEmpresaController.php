<?php

namespace App\Http\Controllers\Empresa;

use App\Models\Empresa;

use App\Traits\CheckEmpresaTrait;
use App\User;

use Caffeinated\Shinobi\Models\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserEmpresaController extends Controller
{
    use CheckEmpresaTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $name)
    {

        $user_empresas = Empresa::findOrFail($id);

        return view('backend.user_empresas.index', compact('user_empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = Empresa::all();
        $roles = Role::get();
        return view('backend.user_empresas.create', compact('empresas', 'roles'));
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
            'is_empresa' => true
        ]);
        $user->roles()->sync($request->get('roles'));

        $user->empresas()->sync($request->get('empresas'));

        $file = $request->file('photo');

        if(!is_null($file)) {
            $extension = strtolower(Input::file('photo')->getClientOriginalExtension());
            $filePath      = $file->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $file->move(storage_path('app/public/jornal/usuario/'. $user->id) .'/perfil/', $fileName);
            $user->photo = $fileName;
            $user->update();
        }
        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.user-empresa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $empresa_id)
    {
        $this->checkEmpresa($empresa_id);
        $user = User::findOrFail($id);
        $empresas = Empresa::all();
        $roles = Role::get();

        return view('backend.user_empresas.show', compact('empresas', 'roles', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $empresa_id)
    {
        $this->checkEmpresa($empresa_id);
        $user_empresa = User::findOrFail($id);
        $empresa = Empresa::findOrFail($empresa_id);
        if (auth()->user()->getRole() == 1) {
            $empresas = Empresa::get();
        } else {
            $empresas = auth()->user()->empresas;
        }
        $roles = Role::get();
        return view('backend.user_empresas.edit', compact('empresa', 'roles', 'user_empresa', 'empresas'));
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
        $user_empresa = User::findOrFail($id);
        $this->checkEmpresa($request->input('empresa_id'));
        $empresa = Empresa::findOrFail($request->input('empresa_id'));
        $this->validate($request, [
            'username' => 'required|unique:users,username,'. $user_empresa->id,
            'email' => 'required|email',
            'telefono' => 'required'
        ]);

        $password = $request->input('password');

        $password_email = $request->input('password_email');


        if (isset($password)) {
            $this->validate($request, [
                'password' => 'required|string|min:6|confirmed',
            ]);
        }

        $user_empresa->username = $request->input('username');
        $user_empresa->nombre = $request->input('nombre');
        $user_empresa->apellido = $request->input('apellido');
        $user_empresa->email = $request->input('email');
        $user_empresa->telefono = $request->input('telefono');

        $user_empresa->telefono = $request->input('telefono');
        if (isset($password)) {
            $user_empresa->password = bcrypt($request->input('password'));
        }

        if (isset($password_email)) {
            $user_empresa->password_email = $request->input('password_email');
        }

            $user_empresa->email_imap = $request->input('email_imap');


        $file = $request->file('photo');
        if(!is_null($file)) {
            $extension = strtolower(Input::file('photo')->getClientOriginalExtension());
            $filePath      = $file->getRealPath();
            $fileName = uniqid().'.'.$extension;
            $file->move(storage_path('app/public/jornal/usuario/'. $user_empresa->id) .'/perfil/', $fileName);
            $user_empresa->photo = $fileName;
            $user_empresa->update();
        }

        $user_empresa->save();
        $user_empresa->roles()->sync($request->input('roles'));
        $user_empresa->empresas()->sync($request->input('empresas'));

        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('empresa.usuarios.index', ['id' => $empresa->id, 'nombre' => $empresa->nombre]);
    }
}
