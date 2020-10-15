<?php

namespace App\Http\Controllers\Backend;

use App\Models\PrestacionPedido;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrestacionPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestaciones_pedidos =  PrestacionPedido::get();
        return view('backend.prestaciones.index', compact('prestaciones_pedidos'));
    }
}
