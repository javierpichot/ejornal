<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 22/10/18
 * Time: 14:17
 */

namespace App\Http\Controllers\Empresa;


use App\Helpers\ComprobarDiasAusente;
use App\Http\Controllers\Controller;
use App\Models\Ausentismo;
use App\Models\AusentismoTipo;
use App\Models\ConsultaMotivo;
use App\Models\Documentacion;
use App\Models\Empresa;
use App\Models\Trabajador;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\DB;
use App\Traits\CheckEmpresaTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EstadisticasController extends Controller
{
    use CheckEmpresaTrait;

    public function show(Request $request, $empresa_id, $nombre)
    {
        $this->checkEmpresa($empresa_id);
        //Mandamos los ausentismo por empresa y asi no realizar mas consultas
        $empresa = Empresa::with(['ausentismo.trabajador'])->findOrFail($empresa_id);


        $year_post = $request->get('fecha_ausencia_anual');

        $year = isset($year_post) ? $year_post : Carbon::now()->format('Y');

        //Sencillo Papi :) -amo las colleccion de Laravel..!
        $top_ausencia_empresa = collect($empresa->ausentismo);
        $top_ten_trabajadores = $top_ausencia_empresa->sortByDesc('dias_ausente')->forPage(1, 10);


        //Top trabajadores con ausentismo veces ausentado
        $top_ten_trabajadores_veces = Trabajador::has('ausentismo')->withCount('ausentismo')->limit(10)->get()->sortByDesc(function($hackathon) use ($empresa)
        {
            $hackathon->where('empresa_id', $empresa->id);
            return $hackathon->ausentismo_count;
        });

        //Top Falcultivos
        $top_facultativos = DB::table('documentacions')
            ->leftJoin('trabajadors', 'documentacions.trabajador_id', '=', 'trabajadors.id')
            ->groupBy('documentacions.medico')
            ->where('trabajadors.empresa_id', $empresa_id)
            ->selectRaw('documentacions.medico, sum(documentacions.reposo) as reposa')
            ->orderBy('reposa', 'desc')
            ->limit(10)
            ->get();

        //Top Facultivo por institucion
        $top_institucion = DB::table('documentacions')
            ->leftJoin('trabajadors', 'documentacions.trabajador_id', '=', 'trabajadors.id')
            ->groupBy('documentacions.institucion')
            ->where('trabajadors.empresa_id', $empresa_id)
            ->selectRaw('documentacions.institucion, sum(documentacions.reposo) as reposi')
            ->orderBy('reposi', 'desc')
            ->limit(10)
            ->get();

        //Total de trabajadores ausentes
        $trabajadores = Ausentismo::withCount(['trabajador', 'trabajador as trabajador_count' => function ($query) {
            $query->orderBy('trabajador_count', 'asc');
        }])->where('empresa_id', $empresa->id)->groupBy('trabajador_id')->get();
        $collection_tra = collect($trabajadores);
        $total_trabajadores_ausentes = $collection_tra->count();
        //Total de trabajadores en la empresa
        $total_trabajadores = Trabajador::where('empresa_id', $empresa_id)->count();
        $numero_ausentistas=$empresa->ausentismo()->whereNull('fecha_alta')->get()->count();
        $ausentismo_actual = $empresa->ausentismo()->whereNull('fecha_alta')->get()->count() / $total_trabajadores * 100;
        $ausentismo_por_accidente = $empresa->ausentismo()->where('ausentismo_tipo_id', 1)->whereNull('fecha_alta')->get()->count();

        //Promedios de dias por ausentismo al año
        $ausentismo = Ausentismo::with('empresa')->where('empresa_id', $empresa->id)->whereNull('fecha_alta')->whereYear('fecha_ausente', $year)->get();
        $collection = collect($ausentismo);
        if ($total_trabajadores_ausentes > 0) {
            $promedio = $collection->sum('dias_ausente')/$total_trabajadores_ausentes;
        } else {
            $promedio = 0;
        }


        //Patología por duración
        $ausentismo_patologico_duracion = Ausentismo::where('ausentismo_tipo_id', 11)->whereYear('fecha_ausente', $year)->get();

        //Patologias por episodio de ausentismo
        $ausentismo_patologico_ene = $empresa->ausentismo()->where('ausentismo_tipo_id', 11)->whereMonth('fecha_ausente', 01)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_patologico_feb = $empresa->ausentismo()->where('ausentismo_tipo_id', 11)->whereMonth('fecha_ausente', 02)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_patologico_mar = $empresa->ausentismo()->where('ausentismo_tipo_id', 11)->whereMonth('fecha_ausente', 03)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_patologico_abr = $empresa->ausentismo()->where('ausentismo_tipo_id', 11)->whereMonth('fecha_ausente', 04)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_patologico_may = $empresa->ausentismo()->where('ausentismo_tipo_id', 11)->whereMonth('fecha_ausente', 05)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_patologico_jun = $empresa->ausentismo()->where('ausentismo_tipo_id', 11)->whereMonth('fecha_ausente', 06)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_patologico_jul = $empresa->ausentismo()->where('ausentismo_tipo_id', 11)->whereMonth('fecha_ausente', 07)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_patologico_ago = $empresa->ausentismo()->where('ausentismo_tipo_id', 11)->whereMonth('fecha_ausente', 8)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_patologico_sep = $empresa->ausentismo()->where('ausentismo_tipo_id', 11)->whereMonth('fecha_ausente', 9)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_patologico_oct = $empresa->ausentismo()->where('ausentismo_tipo_id', 11)->whereMonth('fecha_ausente', 10)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_patologico_nov = $empresa->ausentismo()->where('ausentismo_tipo_id', 11)->whereMonth('fecha_ausente', 11)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_patologico_dic = $empresa->ausentismo()->where('ausentismo_tipo_id', 11)->whereMonth('fecha_ausente', 12)->whereYear('fecha_ausente', $year)->get();


        //Ausentismo anual por mes
        $ausentismo_anual_ene = $empresa->ausentismo()->whereMonth('fecha_ausente', 01)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_anual_feb = $empresa->ausentismo()->whereMonth('fecha_ausente', 02)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_anual_mar = $empresa->ausentismo()->whereMonth('fecha_ausente', 03)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_anual_abr = $empresa->ausentismo()->whereMonth('fecha_ausente', 04)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_anual_may = $empresa->ausentismo()->whereMonth('fecha_ausente', 05)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_anual_jun = $empresa->ausentismo()->whereMonth('fecha_ausente', 06)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_anual_jul = $empresa->ausentismo()->whereMonth('fecha_ausente', 07)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_anual_ago = $empresa->ausentismo()->whereMonth('fecha_ausente', 8)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_anual_sep = $empresa->ausentismo()->whereMonth('fecha_ausente', 9)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_anual_oct = $empresa->ausentismo()->whereMonth('fecha_ausente', 10)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_anual_nov = $empresa->ausentismo()->whereMonth('fecha_ausente', 11)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_anual_dic = $empresa->ausentismo()->whereMonth('fecha_ausente', 12)->whereYear('fecha_ausente', $year)->get();


        //Accidentes al año por mes
        $accidentes_enero = $empresa->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 01)->whereYear('fecha', $year)->get();
        $accidentes_febrero = $empresa->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 02)->whereYear('fecha', $year)->get();
        $accidentes_marzo = $empresa->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 03)->whereYear('fecha', $year)->get();
        $accidentes_abril = $empresa->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 04)->whereYear('fecha', $year)->get();
        $accidentes_mayo = $empresa->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 05)->whereYear('fecha', $year)->get();
        $accidentes_junio = $empresa->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 06)->whereYear('fecha', $year)->get();
        $accidentes_julio = $empresa->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 07)->whereYear('fecha', $year)->get();
        $accidentes_agosto = $empresa->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 8)->whereYear('fecha', $year)->get();
        $accidentes_sep = $empresa->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 9)->whereYear('fecha', $year)->get();
        $accidentes_oct = $empresa->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 10)->whereYear('fecha', $year)->get();
        $accidentes_nov = $empresa->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 11)->whereYear('fecha', $year)->get();
        $accidentes_dic = $empresa->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 12)->whereYear('fecha', $year)->get();


        //Incidentes al año por mes
        $incidencia_enero = $empresa->incidencia()->whereMonth('fecha', 01)->whereYear('fecha', $year)->get();
        $incidencia_febrero = $empresa->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 02)->whereYear('fecha', $year)->get();
        $incidencia_marzo = $empresa->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 03)->whereYear('fecha', $year)->get();
        $incidencia_abril = $empresa->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 04)->whereYear('fecha', $year)->get();
        $incidencia_mayo = $empresa->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 05)->whereYear('fecha', $year)->get();
        $incidencia_junio = $empresa->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 06)->whereYear('fecha', $year)->get();
        $incidencia_julio = $empresa->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 07)->whereYear('fecha', $year)->get();
        $incidencia_agosto = $empresa->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 8)->whereYear('fecha', $year)->get();
        $incidencia_sep = $empresa->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 9)->whereYear('fecha', $year)->get();
        $incidencia_oct = $empresa->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 10)->whereYear('fecha', $year)->get();
        $incidencia_nov = $empresa->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 11)->whereYear('fecha', $year)->get();
        $incidencia_dic = $empresa->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 12)->whereYear('fecha', $year)->get();

        $date = now();
        $start_month = $date->startOfMonth()->format('Y-m-d');
        $end_month = $date->endOfMonth()->format('Y-m-d');

        //Ausencias por dia del mes presente
        $ausemcias_del_mes = \DB::table('ausentismos')
            ->where('empresa_id', $empresa->id)
            ->whereBetween('fecha_ausente' , [$start_month,$end_month])
            ->get()
            ->groupBy('fecha_ausente')
            ->map(function ($item, $key) { return count($item); });

        //Cantidad de ausencia por mes
        $ausencias_por_mes_cantidad = DB::select('SELECT DISTINCT(MONTHNAME(fecha_ausente)) AS month, COUNT(*) AS number_of_ause FROM ausentismos GROUP BY month');


        //Ausentismo por especialidades
        $ausemcias_por_consultas = ConsultaMotivo::has('ausentismo')->withCount(['ausentismo' => function ($query) use ($empresa) {
            $query->where('empresa_id', $empresa->id);
        }])->get();

        //Top trabajadores con ausentismo veces ausentado
        $ausentismo_tipo = AusentismoTipo::has('ausentismo')->withCount('ausentismo')->limit(10)->get()->sortByDesc(function($query) use ($empresa)
        {
            $query->groupBy('fecha_ausente');
            $query->where('empresa_id', $empresa->id);
            $query->orderBy('fecha_ausente', 'desc');
        });

        $anio = $year -1;


        $ausentismo_anual_ene_anter = $empresa->ausentismo()->whereMonth('fecha_ausente', 01)->whereYear('fecha_ausente', $anio)->get();
        $ausentismo_anual_feb_anter = $empresa->ausentismo()->whereMonth('fecha_ausente', 02)->whereYear('fecha_ausente', $anio)->get();
        $ausentismo_anual_mar_anter = $empresa->ausentismo()->whereMonth('fecha_ausente', 03)->whereYear('fecha_ausente', $anio)->get();
        $ausentismo_anual_abr_anter = $empresa->ausentismo()->whereMonth('fecha_ausente', 04)->whereYear('fecha_ausente', $anio)->get();
        $ausentismo_anual_may_anter = $empresa->ausentismo()->whereMonth('fecha_ausente', 05)->whereYear('fecha_ausente', $anio)->get();
        $ausentismo_anual_jun_anter = $empresa->ausentismo()->whereMonth('fecha_ausente', 06)->whereYear('fecha_ausente', $anio)->get();
        $ausentismo_anual_jul_anter = $empresa->ausentismo()->whereMonth('fecha_ausente', 07)->whereYear('fecha_ausente', $anio)->get();
        $ausentismo_anual_ago_anter = $empresa->ausentismo()->whereMonth('fecha_ausente', 8)->whereYear('fecha_ausente', $anio)->get();
        $ausentismo_anual_sep_anter = $empresa->ausentismo()->whereMonth('fecha_ausente', 9)->whereYear('fecha_ausente', $anio)->get();
        $ausentismo_anual_oct_anter = $empresa->ausentismo()->whereMonth('fecha_ausente', 10)->whereYear('fecha_ausente', $anio)->get();
        $ausentismo_anual_nov_anter = $empresa->ausentismo()->whereMonth('fecha_ausente', 11)->whereYear('fecha_ausente', $anio)->get();
        $ausentismo_anual_dic_anter = $empresa->ausentismo()->whereMonth('fecha_ausente', 12)->whereYear('fecha_ausente', $anio)->get();



        /*foreach ($ausentismo_tipo as $ausentism) {
            dd($ausentism->ausentismo->sort());
        }*/


        return view('empresa.estadisticas.show', compact('top_ten_trabajadores', 'year', 'top_ten_trabajadores_veces', 'empresa', 'top_facultativos', 'top_institucion', 'total_trabajadores_ausentes', 'total_trabajadores', 'ausentismo_actual', 'promedio', 'ausentismo_patologico_duracion', 'ausentismo_patologico_ene', 'ausentismo_patologico_feb', 'ausentismo_patologico_mar', 'ausentismo_patologico_abr', 'ausentismo_patologico_may', 'ausentismo_patologico_jun', 'ausentismo_patologico_jul', 'ausentismo_patologico_ago', 'ausentismo_patologico_sep', 'ausentismo_patologico_oct', 'ausentismo_patologico_nov', 'ausentismo_patologico_dic', 'ausentismo_anual_ene', 'ausentismo_anual_feb', 'ausentismo_anual_mar', 'ausentismo_anual_abr', 'ausentismo_anual_may', 'ausentismo_anual_jun', 'ausentismo_anual_jul', 'ausentismo_anual_ago', 'ausentismo_anual_sep', 'ausentismo_anual_oct', 'ausentismo_anual_nov', 'ausentismo_anual_dic', 'accidentes_enero', 'accidentes_febrero', 'accidentes_marzo', 'accidentes_abril', 'accidentes_mayo', 'accidentes_junio', 'accidentes_julio', 'accidentes_agosto', 'accidentes_sep', 'accidentes_oct', 'accidentes_nov', 'accidentes_dic', 'incidencia_enero', 'incidencia_febrero', 'incidencia_marzo', 'incidencia_abril', 'incidencia_mayo', 'incidencia_junio', 'incidencia_julio', 'incidencia_agosto', 'incidencia_sep', 'incidencia_oct', 'incidencia_nov', 'incidencia_dic', 'ausemcias_del_mes', 'ausemcias_por_consultas', 'ausentismo_tipo','numero_ausentistas','ausentismo_por_accidente', 'ausentismo_anual_ene_anter', 'ausentismo_anual_feb_anter', 'ausentismo_anual_mar_anter', 'ausentismo_anual_abr_anter', 'ausentismo_anual_may_anter', 'ausentismo_anual_jun_anter', 'ausentismo_anual_jul_anter', 'ausentismo_anual_ago_anter', 'ausentismo_anual_sep_anter', 'ausentismo_anual_oct_anter', 'ausentismo_anual_nov_anter', 'ausentismo_anual_dic_anter'));
    }

    function generateDates(string $since, string $until = null) {
        $dates = [];

        if (! $until) {
            $until = date('Y-m-d');
        }

        $since = strtotime($since);
        $until = strtotime($until);

        do {
            $period           = date('Y-m', $since); // para agrupar por periodo AÑO-MES
            $dates[$period][] = date('Y-m-d', $since);
            $since            = strtotime("+ 1 day", $since);
        } while($since <= $until);

        return $dates;
    }

}
