<?php namespace App\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\RevisionPeriodicaEntidad;
use App\Models\RevisionPeriodica;
use App\Models\ProfesionalFichada;
use Illuminate\Support\Carbon;

class TareasComposer
{
    public function compose(View $view)
    {
        if (isset($view->empresa)) {
            /**
             * Puntuales
             */
            $tareas_puntuales = RevisionPeriodicaEntidad::with(['revision_periodica'])->where('tipo_tarea_id', 1)->where('role_id', auth()->user()->getRole())->where('empresa_id', $view->empresa->id)->get();
            $historico_tareas_puntuales = 0;

            foreach ($tareas_puntuales as $key => $tarea) {
                $historico_tareas_puntuales = RevisionPeriodica::with(['user', 'revision_periodica_entidad.empresa'])->where('revision_periodica_entidad_id', $tarea->id)->get();
                $historico_tareas_puntuales = number_format($historico_tareas_puntuales->count()*100/100 ,2);
            }
            /**
             * Por turnos
             */
            $tareas_turnos = RevisionPeriodicaEntidad::where('tipo_tarea_id', 4)->where('role_id', auth()->user()->getRole())->where('empresa_id', $view->empresa->id)->get();
            $porcentaje_turnos = 0;
            
            foreach ($tareas_turnos as $key => $tarea) {
                $historico_tareas_turno = RevisionPeriodica::with(['user', 'revision_periodica_entidad.empresa'])->where('revision_periodica_entidad_id', $tarea->id)->where('user_id', auth()->user()->id)->get();

                if( count($tareas_turnos) == 0 || count($historico_tareas_turno) ==0 ){
                    $porcentaje_turnos = 100;
                } else {
                    $porcentaje_turnos = (1/(count($historico_tareas_turno)/count($tareas_turnos)));
                }

            }
            /**
             * Diarias
             */
            $tareas_diarias = RevisionPeriodicaEntidad::where('tipo_tarea_id', 2)->where('role_id', auth()->user()->getRole())->where('empresa_id', $view->empresa->id)->get();
            $porcentaje_diarios = 0;

            foreach ($tareas_diarias as $key => $tarea) {
                $historico_tareas_diarias = RevisionPeriodica::with(['user', 'revision_periodica_entidad.empresa'])->where('revision_periodica_entidad_id', $tarea->id)->get();
                $porcentaje_diarios = number_format($historico_tareas_diarias->count()*100/100) / 100;
            }
            /**
             * Mensuales
             */
            $tareas_mensuales = RevisionPeriodicaEntidad::where('tipo_tarea_id', 3)->where('role_id', auth()->user()->getRole())->where('empresa_id', $view->empresa->id)->get();
            $pocentaje_mes =number_format($tareas_mensuales->count()*100/100 ,2);


            /**
             * Fichadas
             */
            $ultima_entrada = 0;
            $ultima_salida = 0;
            $ficho_entrada = 0;
            $ficho_salida = 0;
            if (isset(auth()->user()->profesional->id)) {
                $ultima_entrada = ProfesionalFichada::where('profesional_id', auth()->user()->profesional->id)->orderBy('created_at', 'DESC')->first();
                $ultima_salida = ProfesionalFichada::where('profesional_id', auth()->user()->profesional->id)->whereNotNull('fechahora_salida')->orderBy('created_at', 'DESC')->first();
                $ficho_entrada = ProfesionalFichada::whereDay('fechahora_entrada', Carbon::now()->day)->first();
                $ficho_salida = ProfesionalFichada::whereNotNull('fechahora_salida')->whereDay('fechahora_entrada', Carbon::now()->day)->first();
            }
            

            $view->with(['historico_tareas_puntuales' => $historico_tareas_puntuales, 'porcentaje_turnos' => $porcentaje_turnos, 'tareas_diarias' => $tareas_diarias, 'pocentaje_mes' => $pocentaje_mes, 'tareas_puntuales' => $tareas_puntuales, 'tareas_turnos' => $tareas_turnos, 'porcentaje_diarios' => $porcentaje_diarios, 'tareas_mensuales' => $tareas_mensuales, 'ultima_entrada' => $ultima_entrada, 'ultima_salida' => $ultima_salida, 'ficho_entrada' => $ficho_entrada, 'ficho_salida' => $ficho_salida]);

        }
       
    }
}

