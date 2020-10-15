<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 4/27/2019
 * Time: 6:39 p.m.
 */

namespace App\Http\Controllers\Empresa;


use App\Http\Controllers\Controller;
use App\Imports\ImportTrabajadors;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ImportTrabajadoresController extends Controller
{
    public function index($id, $name)
    {
        $empresa = Empresa::findOrFail($id);
        return view('imports.index', compact('empresa'));
    }

    public function store(Request $request)
    {
        Excel::import(new ImportTrabajadors(), $request->file('file'));
        Session::flash('alert', 'Los datos se han almacenado exitosamente.');
        return back();
    }
}
