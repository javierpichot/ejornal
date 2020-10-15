<?php namespace App\Http\Controllers\Backend;

use App\Models\Tarea;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Empresa;
use App\Models\Sector;
use App\Models\Turno;
use Illuminate\Http\Request;
use Session;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::all();
        return view('backend.empresa.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categoria::get();
        $sectors = Sector::get();
        $turnos = Turno::get();
        return view('backend.empresa.create', compact('categories', 'sectors', 'turnos'));
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
            'nombre' => 'required|unique:empresas',
            'cuit' => 'required|numeric',
            'direccion' => 'required',
            'nombre_categoria' => 'required',
            'nombre_sector' => 'required',
            'nombre_turno' => 'required',
            'nombre_tarea' => 'required',
            'caducidad' => 'required|date'
        ]);



        $attributes = collect($request->all());

        $empresa = Empresa::create($attributes->except('_token', 'nombre_tarea', 'logo')->all());

        if ($request->input('nombre_tarea') != null) {
            foreach (explode(',',  $request->input('nombre_tarea')) as $key => $value) {
                $empresa->tarea()->create([
                    'nombre' => $value
                ]);
            }
        }

        if ($request->input('nombre_categoria') != null) {
            foreach (explode(',',  $request->input('nombre_categoria')) as $key => $value) {
                $empresa->categoria()->create([
                    'nombre' => $value
                ]);
            }
        }

        if ($request->input('nombre_sector') != null) {
            foreach (explode(',',  $request->input('nombre_sector')) as $key => $value) {
                $empresa->sector()->create([
                    'nombre' => $value
                ]);
            }
        }

        if ($request->input('nombre_turno') != null) {
            foreach (explode(',',  $request->input('nombre_turno')) as $key => $value) {
                $empresa->turno()->create([
                    'nombre' => $value
                ]);
            }
        }

         $file = $request->file('logo');

         if(!is_null($file)) {
             $extension = strtolower(Input::file('logo')->getClientOriginalExtension());
             $filePath      = $file->getRealPath();
             $fileName = uniqid().'.'.$extension;
             $file->move(storage_path('app/public/empresas/'. $empresa->id) .'/perfil/', $fileName);
             $empresa->logo = $fileName;
             $empresa->update();
         }
        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.empresa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show($id, Empresa $empresa)
    {
        $empresa = $empresa->findOrFail($id);

        return view('backend.empresa.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Empresa $empresa)
    {
        $categories = Categoria::get();
        $sectors = Sector::get();
        $turnos = Turno::get();
        return view('backend.empresa.edit')->with([
            'categories' => $categories,
            'sectors' => $sectors,
            'turnos' => $turnos,
            'empresa' => $empresa->with(['tarea'])->findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Empresa $empresa)
    {
        $empresa = $empresa->findOrFail($id);

         $this->validate($request, [
            'nombre' => 'sometimes|required|unique:empresas,nombre,'. $empresa->id,
            'cuit' => 'required|numeric',
            'direccion' => 'required',
            'nombre_categoria' => 'required',
            'nombre_sector' => 'required',
            'nombre_turno' => 'required',
            'nombre_tarea' => 'required',
            'caducidad' => 'required|date'
        ]);


        $empresa->fill($request->except('_token', '_method', 'nombre_tarea', 'nombre_turno', 'nombre_sector', 'nombre_categoria'))
                ->update();




                if ($request->input('nombre_tarea') != null) {
                    foreach (explode(',',  $request->input('nombre_tarea')) as $key => $value) {
                        //Actualizamos o Creamos si no existe
                        $empresa->tarea()->updateOrCreate(
                        [
                            'nombre' => $value
                        ]
                        );
                    }
                }

                if ($request->input('nombre_categoria') != null) {
                    foreach (explode(',',  $request->input('nombre_categoria')) as $key => $value) {
                        //Actualizamos o Creamos si no existe
                        $empresa->categoria()->updateOrCreate(
                        [
                            'nombre' => $value
                        ]
                        );
                    }
                }

                if ($request->input('nombre_sector') != null) {
                    foreach (explode(',',  $request->input('nombre_sector')) as $key => $value) {
                        //Actualizamos o Creamos si no existe
                        $empresa->sector()->updateOrCreate(
                        [
                            'nombre' => $value
                        ]
                        );
                    }
                }

                if ($request->input('nombre_turno') != null) {
                    foreach (explode(',',  $request->input('nombre_turno')) as $key => $value) {
                        //Actualizamos o Creamos si no existe
                        $empresa->turno()->updateOrCreate(
                        [
                            'nombre' => $value
                        ]
                        );
                    }
                }

                $file = $request->file('logo');

                if(!is_null($file)) {
                    $extension = strtolower(Input::file('logo')->getClientOriginalExtension());
                    $filePath      = $file->getRealPath();
                    $fileName = uniqid().'.'.$extension;
                     $file->move(storage_path('app/public/empresas/'. $empresa->id) .'/perfil/', $fileName);
                    $empresa->logo = $fileName;
                    $empresa->update();
                }
            Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return redirect()->route('admin.empresa.index');

    }
}
