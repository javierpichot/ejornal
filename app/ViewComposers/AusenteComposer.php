<?php namespace App\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\Ausentismo;

class AusenteComposer
{
    public function compose(View $view)
    {
        if (isset($view->trabajador)) {
            $ausente = Ausentismo::with(['ausentismo_tipo'])->where( 'trabajador_id', $view->trabajador->id)->whereNull('fecha_alta')->get();
            view()->share(['ausente' => $ausente]);
        }
       
    }
}

