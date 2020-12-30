<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Empresa;

use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {

        if (auth()->user()->isRole('super-admin')) {
           $empresas = Empresa::get();
           return view('adminlte::home', compact('empresas'));
       } else {
           $empresas = auth()->user()->empresas()->get();
           if (count($empresas) == 1) {
             return redirect()->route('empresa.show', ['id' => $empresas[0]->id, 'name' => $empresas[0]->nombre]);
           }else {
             return view('adminlte::home', compact('empresas'));
           }
       }


    }



}
