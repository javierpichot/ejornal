<?php

namespace App\Http\Controllers\Empresa;

use App\Models\Sector;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Spatie\Activitylog\Models\Activity;

class SectorController extends Controller
{

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(Request $request, $id)
     {
         $sector = Sector::where('nombre', $request->nombre)->where('empresa_id', $id);

         $sector->delete();
     }
}
