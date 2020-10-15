<?php

namespace App\Http\Controllers\Backend;

use App\Models\Tarea;
use App\Models\Empresa;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;

class TareaController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Empresa::findOrFail($id);
        $tarea = Tarea::where('nombre', $request->input('nombre'))->firstOrFail();
        $tarea->delete();
    }
}
