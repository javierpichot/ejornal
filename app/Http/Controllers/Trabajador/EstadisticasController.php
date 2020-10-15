<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 22/10/18
 * Time: 14:17
 */

namespace App\Http\Controllers\Trabajador;


use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Trabajador;
use App\Traits\CheckEmpresaTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Ausentismo;

/**
 * Class EstadisticasController
 * @package App\Http\Controllers\Trabajador
 */
class EstadisticasController extends Controller
{
    use CheckEmpresaTrait;

    /**
     * @param $id
     * @param $nombre
     * @param $empresa_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, $id, $nombre, $empresa_id)
    {
        $this->checkEmpresa($empresa_id);
        $empresa = Empresa::findOrFail($empresa_id);
        $trabajador = Trabajador::findOrFail($id);

        $year_post = $request->get('fecha_ausencia_anual');

        $year = isset($year_post) ? $year_post : Carbon::now()->format('Y');

        //Ausemtismo del año
        $ausentismo_enero = $trabajador->ausentismo()->whereMonth('fecha_ausente', 01)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_febrero = $trabajador->ausentismo()->whereMonth('fecha_ausente', 02)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_marzo = $trabajador->ausentismo()->whereMonth('fecha_ausente', 03)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_abril = $trabajador->ausentismo()->whereMonth('fecha_ausente', 04)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_mayo = $trabajador->ausentismo()->whereMonth('fecha_ausente', 05)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_junio = $trabajador->ausentismo()->whereMonth('fecha_ausente', 06)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_julio = $trabajador->ausentismo()->whereMonth('fecha_ausente', 07)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_agosto = $trabajador->ausentismo()->whereMonth('fecha_ausente', 8)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_sep = $trabajador->ausentismo()->whereMonth('fecha_ausente', 9)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_oct = $trabajador->ausentismo()->whereMonth('fecha_ausente', 10)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_nov = $trabajador->ausentismo()->whereMonth('fecha_ausente', 11)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_dic = $trabajador->ausentismo()->whereMonth('fecha_ausente', 12)->whereYear('fecha_ausente', $year)->get();

        $ausentismo_alergo = $trabajador->ausentismo()->where('consulta_motivo_id', 1)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_angio = $trabajador->ausentismo()->where('consulta_motivo_id', 2)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_cardio = $trabajador->ausentismo()->where('consulta_motivo_id', 3)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_gastro = $trabajador->ausentismo()->where('consulta_motivo_id', 4)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_derma = $trabajador->ausentismo()->where('consulta_motivo_id', 5)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_endocrino = $trabajador->ausentismo()->where('consulta_motivo_id', 6)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_hemato = $trabajador->ausentismo()->where('consulta_motivo_id', 7)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_infecto = $trabajador->ausentismo()->where('consulta_motivo_id', 8)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_nefro = $trabajador->ausentismo()->where('consulta_motivo_id', 9)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_neumo = $trabajador->ausentismo()->where('consulta_motivo_id', 10)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_neuro = $trabajador->ausentismo()->where('consulta_motivo_id', 11)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_odonto = $trabajador->ausentismo()->where('consulta_motivo_id', 12)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_oftalmo = $trabajador->ausentismo()->where('consulta_motivo_id', 13)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_otorrino = $trabajador->ausentismo()->where('consulta_motivo_id', 14)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_onco = $trabajador->ausentismo()->where('consulta_motivo_id', 15)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_procto = $trabajador->ausentismo()->where('consulta_motivo_id', 16)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_psiqui = $trabajador->ausentismo()->where('consulta_motivo_id', 17)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_reumato = $trabajador->ausentismo()->where('consulta_motivo_id', 18)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_trauma = $trabajador->ausentismo()->where('consulta_motivo_id', 19)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_toxico = $trabajador->ausentismo()->where('consulta_motivo_id', 20)->whereYear('fecha_ausente', $year)->get();
        $ausentismo_uro = $trabajador->ausentismo()->where('consulta_motivo_id', 21)->whereYear('fecha_ausente', $year)->get();



        $incidencia_enero = $trabajador->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 01)->whereYear('fecha', $year)->get();
        $incidencia_febrero = $trabajador->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 02)->whereYear('fecha', $year)->get();
        $incidencia_marzo = $trabajador->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 03)->whereYear('fecha', $year)->get();
        $incidencia_abril = $trabajador->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 04)->whereYear('fecha', $year)->get();
        $incidencia_mayo = $trabajador->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 05)->whereYear('fecha', $year)->get();
        $incidencia_junio = $trabajador->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 06)->whereYear('fecha', $year)->get();
        $incidencia_julio = $trabajador->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 07)->whereYear('fecha', $year)->get();
        $incidencia_agosto = $trabajador->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 8)->whereYear('fecha', $year)->get();
        $incidencia_sep = $trabajador->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 9)->whereYear('fecha', $year)->get();
        $incidencia_oct = $trabajador->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 10)->whereYear('fecha', $year)->get();
        $incidencia_nov = $trabajador->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 11)->whereYear('fecha', $year)->get();
        $incidencia_dic = $trabajador->incidencia()->where('tipo_incidencia_id', 3)->whereMonth('fecha', 12)->whereYear('fecha', $year)->get();


        $accidentes_enero = $trabajador->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 01)->whereYear('fecha', $year)->get();
        $accidentes_febrero = $trabajador->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 02)->whereYear('fecha', $year)->get();
        $accidentes_marzo = $trabajador->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 03)->whereYear('fecha', $year)->get();
        $accidentes_abril = $trabajador->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 04)->whereYear('fecha', $year)->get();
        $accidentes_mayo = $trabajador->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 05)->whereYear('fecha', $year)->get();
        $accidentes_junio = $trabajador->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 06)->whereYear('fecha', $year)->get();
        $accidentes_julio = $trabajador->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 07)->whereYear('fecha', $year)->get();
        $accidentes_agosto = $trabajador->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 8)->whereYear('fecha', $year)->get();
        $accidentes_sep = $trabajador->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 9)->whereYear('fecha', $year)->get();
        $accidentes_oct = $trabajador->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 10)->whereYear('fecha', $year)->get();
        $accidentes_nov = $trabajador->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 11)->whereYear('fecha', $year)->get();
        $accidentes_dic = $trabajador->incidencia()->where('tipo_incidencia_id', 1)->whereMonth('fecha', 12)->whereYear('fecha', $year)->get();


        $accidentes_iti_enero = $trabajador->incidencia()->where('tipo_incidencia_id', 2)->whereMonth('fecha', 01)->whereYear('fecha', $year)->get();
        $accidentes_iti_febrero = $trabajador->incidencia()->where('tipo_incidencia_id', 2)->whereMonth('fecha', 02)->whereYear('fecha', $year)->get();
        $accidentes_iti_marzo = $trabajador->incidencia()->where('tipo_incidencia_id', 2)->whereMonth('fecha', 03)->whereYear('fecha', $year)->get();
        $accidentes_iti_abril = $trabajador->incidencia()->where('tipo_incidencia_id', 2)->whereMonth('fecha', 04)->whereYear('fecha', $year)->get();
        $accidentes_iti_mayo = $trabajador->incidencia()->where('tipo_incidencia_id', 2)->whereMonth('fecha', 05)->whereYear('fecha', $year)->get();
        $accidentes_iti_junio = $trabajador->incidencia()->where('tipo_incidencia_id', 2)->whereMonth('fecha', 06)->whereYear('fecha', $year)->get();
        $accidentes_iti_julio = $trabajador->incidencia()->where('tipo_incidencia_id', 2)->whereMonth('fecha', 07)->whereYear('fecha', $year)->get();
        $accidentes_iti_agosto = $trabajador->incidencia()->where('tipo_incidencia_id', 2)->whereMonth('fecha', 8)->whereYear('fecha', $year)->get();
        $accidentes_iti_sep = $trabajador->incidencia()->where('tipo_incidencia_id', 2)->whereMonth('fecha', 9)->whereYear('fecha', $year)->get();
        $accidentes_iti_oct = $trabajador->incidencia()->where('tipo_incidencia_id', 2)->whereMonth('fecha', 10)->whereYear('fecha', $year)->get();
        $accidentes_iti_nov = $trabajador->incidencia()->where('tipo_incidencia_id', 2)->whereMonth('fecha', 11)->whereYear('fecha', $year)->get();
        $accidentes_iti_dic = $trabajador->incidencia()->where('tipo_incidencia_id', 2)->whereMonth('fecha', 12)->whereYear('fecha', $year)->get();


        $ausentismo_anual = $trabajador->ausentismo()->whereYear('fecha_ausente', $year)->get();


        $incidencia_anual = $trabajador->incidencia()->whereYear('fecha', $year)->get();

        $consulta_ene = $trabajador->consulta()->whereMonth('created_at', 01)->whereYear('created_at', $year)->get();
        $consulta_feb = $trabajador->consulta()->whereMonth('created_at', 02)->whereYear('created_at', $year)->get();
        $consulta_mar = $trabajador->consulta()->whereMonth('created_at', 03)->whereYear('created_at', $year)->get();
        $consulta_abr = $trabajador->consulta()->whereMonth('created_at', 04)->whereYear('created_at', $year)->get();
        $consulta_may = $trabajador->consulta()->whereMonth('created_at', 05)->whereYear('created_at', $year)->get();
        $consulta_jun = $trabajador->consulta()->whereMonth('created_at', 06)->whereYear('created_at', $year)->get();
        $consulta_jul = $trabajador->consulta()->whereMonth('created_at', 07)->whereYear('created_at', $year)->get();
        $consulta_ago = $trabajador->consulta()->whereMonth('created_at', 8)->whereYear('created_at', $year)->get();
        $consulta_sep = $trabajador->consulta()->whereMonth('created_at', 9)->whereYear('created_at', $year)->get();
        $consulta_oct = $trabajador->consulta()->whereMonth('created_at', 10)->whereYear('created_at', $year)->get();
        $consulta_nov = $trabajador->consulta()->whereMonth('created_at', 11)->whereYear('created_at', $year)->get();
        $consulta_dic = $trabajador->consulta()->whereMonth('created_at', 12)->whereYear('created_at', $year)->get();






        /*$ausentismo = Ausentismo::where('trabajador_id',  $trabajador->id)->whereYear('fecha_ausente', $year)->first();

        if (empty($ausentismo)) {
          $ausencia = isset($ausentismo->fecha_ausente) ? $ausentismo->fecha_ausente : $year."-01-01";
          $alta = Ausentismo::where('trabajador_id',  $trabajador->id)->whereYear('fecha_alta', $year)->first();
          $end =  $alta->fecha_alta;
        } else {
          $ausencia = isset($ausentismo->fecha_ausente) ? $ausentismo->fecha_ausente : $year."-01-01";
          $end =  $ausentismo->fecha_alta;
        }
        $ausentismos_anuales = $this->generateDates($ausencia, $end);*/

        $ausentismo = Ausentismo::where('trabajador_id',  $trabajador->id)->whereYear('fecha_ausente', $year)->get();
    
       
        if ($ausentismo->isEmpty()) {
          $ausentismo = Ausentismo::where('trabajador_id',  $trabajador->id)->whereNull('fecha_alta')->get();
         //dd($ausentismo);

         if($ausentismo->isEmpty()) {
          $ausentismo = Ausentismo::where('trabajador_id',  $trabajador->id)->whereYear('fecha_alta', $year)->get();
          $ausentismos_anuales = "";
          foreach ($ausentismo as $key => $row) {
            $ausentismos_anuales = $this->generateAusencia($row->fecha_ausente, $row->fecha_alta);
          }
         } else {
          $ausentismos_anuales = "";
          foreach ($ausentismo as $key => $row) {
            $ausentismos_anuales = $this->generateAusencia($row->fecha_ausente, $row->fecha_alta);
          }
         }
          


        } else {
          $ausentismos_anuales = "";
          foreach ($ausentismo as $key => $row) {
            $ausentismos_anuales = $this->generateAusencia($row->fecha_ausente, $row->fecha_alta);
          }
        }
        




        $ausentismo_anual_widget = $trabajador->ausentismo()->get();
      $i=0;
      $promedio=0;
foreach ($ausentismo_anual_widget as $clave => $valor){
  
  $promedio+=$ausentismo_anual_widget[$clave]["dias_ausente"];

     $i+=1;
      }
      if($i!=0){
$ausentismo_anual_widget=$promedio/$i;}else{
        $ausentismo_anual_widget=0;
      }
      $ausentismo_anual_widget2="0";
 if($trabajador->ausentismo()->get()->count()!=0){
             $ausentismo_anual_widget2 = 30/ $trabajador->ausentismo()->get()->count();
 }

      
        $accidentes = $trabajador->incidencia()->where('tipo_incidencia_id', 1)->get();
        $accidentes_in_ite = $trabajador->incidencia()->where('tipo_incidencia_id', 2)->get();
        $incidentes = $trabajador->incidencia()->where('tipo_incidencia_id', 3)->get();

        $documentacion_ausencia_ene = $trabajador->documentacion()->whereMonth('fecha_entrega', 01)->whereYear('fecha_entrega', $year)->get();
        $documentacion_ausencia_feb = $trabajador->documentacion()->whereMonth('fecha_entrega', 02)->whereYear('fecha_entrega', $year)->get();
        $documentacion_ausencia_mar = $trabajador->documentacion()->whereMonth('fecha_entrega', 03)->whereYear('fecha_entrega', $year)->get();
        $documentacion_ausencia_abr = $trabajador->documentacion()->whereMonth('fecha_entrega', 04)->whereYear('fecha_entrega', $year)->get();
        $documentacion_ausencia_may = $trabajador->documentacion()->whereMonth('fecha_entrega', 05)->whereYear('fecha_entrega', $year)->get();
        $documentacion_ausencia_jun = $trabajador->documentacion()->whereMonth('fecha_entrega', 06)->whereYear('fecha_entrega', $year)->get();
        $documentacion_ausencia_jul = $trabajador->documentacion()->whereMonth('fecha_entrega', 07)->whereYear('fecha_entrega', $year)->get();
        $documentacion_ausencia_ago = $trabajador->documentacion()->whereMonth('fecha_entrega', 8)->whereYear('fecha_entrega', $year)->get();
        $documentacion_ausencia_sep = $trabajador->documentacion()->whereMonth('fecha_entrega', 9)->whereYear('fecha_entrega', $year)->get();
        $documentacion_ausencia_oct = $trabajador->documentacion()->whereMonth('fecha_entrega', 10)->whereYear('fecha_entrega', $year)->get();
        $documentacion_ausencia_nov = $trabajador->documentacion()->whereMonth('fecha_entrega', 11)->whereYear('fecha_entrega', $year)->get();
        $documentacion_ausencia_dic = $trabajador->documentacion()->whereMonth('fecha_entrega', 12)->whereYear('fecha_entrega', $year)->get();



 $consulta_alergo = $trabajador->consulta()->where('consulta_motivo_id', 1)->whereYear('created_at', $year)->get();
        $consulta_angio = $trabajador->consulta()->where('consulta_motivo_id', 2)->whereYear('created_at', $year)->get();
        $consulta_cardio = $trabajador->consulta()->where('consulta_motivo_id', 3)->whereYear('created_at', $year)->get();
        $consulta_gastro = $trabajador->consulta()->where('consulta_motivo_id', 4)->whereYear('created_at', $year)->get();
        $consulta_derma = $trabajador->consulta()->where('consulta_motivo_id', 5)->whereYear('created_at', $year)->get();
        $consulta_endocrino = $trabajador->consulta()->where('consulta_motivo_id', 6)->whereYear('created_at', $year)->get();
        $consulta_hemato = $trabajador->consulta()->where('consulta_motivo_id', 7)->whereYear('created_at', $year)->get();
        $consulta_infecto = $trabajador->consulta()->where('consulta_motivo_id', 8)->whereYear('created_at', $year)->get();
        $consulta_nefro = $trabajador->consulta()->where('consulta_motivo_id', 9)->whereYear('created_at', $year)->get();
        $consulta_neumo = $trabajador->consulta()->where('consulta_motivo_id', 10)->whereYear('created_at', $year)->get();
        $consulta_neuro = $trabajador->consulta()->where('consulta_motivo_id', 11)->whereYear('created_at', $year)->get();
        $consulta_odonto = $trabajador->consulta()->where('consulta_motivo_id', 12)->whereYear('created_at', $year)->get();
        $consulta_oftalmo = $trabajador->consulta()->where('consulta_motivo_id', 13)->whereYear('created_at', $year)->get();
        $consulta_otorrino = $trabajador->consulta()->where('consulta_motivo_id', 14)->whereYear('created_at', $year)->get();
        $consulta_onco = $trabajador->consulta()->where('consulta_motivo_id', 15)->whereYear('created_at', $year)->get();
        $consulta_procto = $trabajador->consulta()->where('consulta_motivo_id', 16)->whereYear('created_at', $year)->get();
        $consulta_psiqui = $trabajador->consulta()->where('consulta_motivo_id', 17)->whereYear('created_at', $year)->get();
        $consulta_reumato = $trabajador->consulta()->where('consulta_motivo_id', 18)->whereYear('created_at', $year)->get();
        $consulta_trauma = $trabajador->consulta()->where('consulta_motivo_id', 19)->whereYear('created_at', $year)->get();
        $consulta_toxico = $trabajador->consulta()->where('consulta_motivo_id', 20)->whereYear('created_at', $year)->get();
        $consulta_uro = $trabajador->consulta()->where('consulta_motivo_id', 21)->whereYear('created_at', $year)->get();






        return view('trabajador.estadisticas.show', compact('empresa', 'year', 'ausentismos_anuales', 'trabajador', 'ausentismo_enero', 'ausentismo_febrero', 'ausentismo_marzo', 'ausentismo_abril', 'ausentismo_anual', 'incidencia_anual',  'ausentismo_mayo', 'ausentismo_junio', 'ausentismo_julio', 'ausentismo_agosto', 'ausentismo_sep', 'ausentismo_oct', 'ausentismo_nov', 'ausentismo_dic', 'incidencia_enero', 'incidencia_febrero', 'incidencia_marzo', 'incidencia_abril', 'incidencia_mayo', 'incidencia_junio', 'incidencia_julio', 'incidencia_agosto', 'incidencia_sep', 'incidencia_oct', 'incidencia_nov', 'incidencia_dic',
         'accidentes_enero', 'accidentes_febrero', 'accidentes_marzo', 'accidentes_abril', 'accidentes_mayo', 'accidentes_junio', 'accidentes_julio', 'accidentes_agosto', 'accidentes_sep', 'accidentes_oct', 'accidentes_nov', 'accidentes_dic',

          'accidentes_iti_enero', 'accidentes_iti_febrero', 'accidentes_iti_marzo', 'accidentes_iti_abril', 'accidentes_iti_mayo', 'accidentes_iti_junio', 'accidentes_iti_julio', 'accidentes_iti_agosto', 'accidentes_iti_sep', 'accidentes_iti_oct', 'accidentes_iti_nov', 'accidentes_iti_dic',
          'consulta_ene', 'consulta_feb', 'consulta_mar', 'consulta_abr', 'consulta_may', 'consulta_jun', 'consulta_jul', 'consulta_ago', 'consulta_sep', 'consulta_oct', 'consulta_nov', 'consulta_dic',

          
 'consulta_alergo', 'consulta_angio', 'consulta_cardio', 'consulta_gastro', 'consulta_derma', 'consulta_endocrino', 'consulta_hemato','consulta_infecto','consulta_nefro','consulta_neumo','consulta_neuro','consulta_odonto','consulta_oftalmo','consulta_otorrino','consulta_onco','consulta_procto','consulta_psiqui','consulta_reumato','consulta_trauma','consulta_toxico','consulta_uro',
                                                            
          'documentacion_ausencia_ene', 'documentacion_ausencia_feb', 'documentacion_ausencia_mar', 'documentacion_ausencia_abr', 'documentacion_ausencia_may', 'documentacion_ausencia_jun', 'documentacion_ausencia_jul', 'documentacion_ausencia_ago',
          'documentacion_ausencia_sep', 'documentacion_ausencia_oct', 'documentacion_ausencia_nov', 'documentacion_ausencia_dic',

         'accidentes', 'accidentes_in_ite', 'incidentes', 
  
                                                            
                                                            
                                                            
                                                            'ausentismo_alergo', 'ausentismo_angio', 'ausentismo_cardio', 'ausentismo_gastro', 'ausentismo_derma', 'ausentismo_endocrino', 'ausentismo_hemato','ausentismo_infecto','ausentismo_nefro','ausentismo_neumo','ausentismo_neuro','ausentismo_odonto','ausentismo_oftalmo','ausentismo_otorrino','ausentismo_onco','ausentismo_procto','ausentismo_psiqui','ausentismo_reumato','ausentismo_trauma','ausentismo_toxico','ausentismo_uro', 'ausentismo_anual_widget', 'ausentismo_anual_widget2'
                                                           
                                                           
                                                      ));
    }

    public function generateAusencia($since, $until)
    {
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
    } while($since  <=  $until);

    return $dates;
    }

    /**
     * by kelly :)
     */
    private function generateDates(string $since, string $until = null) {
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

  function isArray($x) : bool {
    return !$this->isAssociative($x);
  }
  
  /**
   * Is Associative Array?
   * @param mixed $x
   * @return bool
   */
  function isAssociative($x) : bool {
    if (!is_array($x)) {
      return false;
    }
    $i = count($x);
    while ($i > 0) {
      if (!isset($x[--$i])) {
        return true;
      }
    }
    return false;
  }
}
