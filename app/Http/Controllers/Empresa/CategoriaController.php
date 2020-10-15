<?php

namespace App\Http\Controllers\Empresa;

use App\Models\Categoria;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Spatie\Activitylog\Models\Activity;

class CategoriaController extends Controller
{

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $categoria = Categoria::where('nombre', $request->nombre)->where('empresa_id', $id);

        $categoria->delete();
    }
}
