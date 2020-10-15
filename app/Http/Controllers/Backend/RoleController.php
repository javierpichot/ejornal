<?php

namespace App\Http\Controllers\Backend;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('backend.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $permissions = Permission::get();
        return view('backend.role.create', compact('permissions'));
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
            'name' => 'required|unique:roles',
            'slug' => 'required|unique:roles'
        ]);


        $model = Role::create($request->except('_token', 'permissions'));

        $model->permissions()->sync($request->get('permissions'));

        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.roles.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::get();
        return view('backend.role.edit', compact('role', 'permissions'));
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
        $role = Role::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $role->id,
            'slug' => 'required|unique:roles,slug,' . $role->id,
        ]);
        $role->update($request->all());

        $role->permissions()->sync($request->get('permissions'));

      
        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if(  $role->delete() ) {
            $response = [
                'id'        =>  $role->id,
                'status'    =>  'success',
                'message'   =>  'El profesional ha sido eliminado',
            ];
        } else {
            $response = [
                'status'    =>  'error',
                'message'   =>  'Intentelo nuevamente'
            ];
        }

        if( \request()->ajax() ) {
            return new JsonResponse($response);
        } else {

        }
    }
}
