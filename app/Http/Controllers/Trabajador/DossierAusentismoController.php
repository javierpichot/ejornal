<?php

namespace App\Http\Controllers\Trabajador;

use App\Models\Empresa;
use App\Models\Ausentismo;
use App\Models\Trabajador;
use App\Models\Calendario;
use DateTime;
use DatePeriod;
use DateInterval;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class DossierAusentismoController
 * @package App\Http\Controllers\Trabajador
 */
class DossierAusentismoController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $empresa_id, $trabajador_id)
    {
        $empresa = Empresa::findOrFail($empresa_id);
        $trabajador = Trabajador::findOrFail($trabajador_id);
        $cobertura_dias = array();
        $array_cobertura = [];

        $ausentismo = Ausentismo::with(['empresa', 'ausentismo_tipo', 'comunicacion', 'documentacion', 'consulta'])->findOrFail($id);
        foreach ($ausentismo->documentacion as $key => $documentacion) {
            if ($documentacion['documentacion_tipo_id'] == 1) {

                $array_cobertura[] = $this->array_cobertura($documentacion['fecha_documento'], $documentacion['reposo'], $documentacion['documentacion_tipo_id'], $documentacion['fecha_incorporacion'], $documentacion['fecha_entrega'], $documentacion['institucion'], $documentacion['medico'], $documentacion['diagnostico']);
                $estado[$documentacion['fecha_documento']] = $this->comprobar_regularidad($documentacion['fecha_documento'], $documentacion['reposo'], $documentacion['documentacion_tipo_id'], $documentacion['fecha_incorporacion'], $documentacion['fecha_entrega'], $documentacion['institucion'], $documentacion['medico'], $documentacion['diagnostico']);

            }
        }

        $result = [];
        foreach ($array_cobertura as $arr) {
            $result = array_merge($result, $arr);
        }
        $array_cobertura = $result;

        return view('trabajador.expediente.dossier', compact('empresa', 'trabajador', 'ausentismo', 'estado'));

    }

    /**
     * @param $documentacion_fecha_documento
     * @param $documentacion_reposo
     * @param $documentacion_tipo_id
     * @param $documentacion_fecha_incorporacion
     * @param $fecha_entrega
     * @param $documentacion_institucion
     * @param $documentacion_medico
     * @param $documentacion_diagnostico
     * @return array
     * @throws \Exception
     */
    public function array_cobertura($documentacion_fecha_documento, $documentacion_reposo, $documentacion_tipo_id, $documentacion_fecha_incorporacion, $fecha_entrega, $documentacion_institucion, $documentacion_medico, $documentacion_diagnostico)
    {
        $fechas_feriado = Calendario::where('tipo', true)->get();
        $raya = [];
        $entrega = '';
        $alt = '';
        $fecha_cobertura = date('Y-m-d', strtotime("+" . $documentacion_reposo . " day", strtotime($documentacion_fecha_documento)));

        foreach ($fechas_feriado as $key => $fecha) {
            $raya[] = $fecha->fecha_feriado;
        }


        if ($documentacion_tipo_id == 1) {

            if ((new DateTime($fecha_cobertura) >= new DateTime($documentacion_fecha_incorporacion)) or ($documentacion_fecha_incorporacion == "")) {
                $cubierto = true;
            } else {
                $cubierto = false;
            }

            if (($fecha_entrega <= $documentacion_fecha_incorporacion) or ($documentacion_fecha_incorporacion == "")) {
                $entrega = true;
            } else {
                $entrega = false;
            }
            $documentacion_notifico = true;
            $array_cobertura = array();

            if ($documentacion_notifico == true && $documentacion_diagnostico != "" && $documentacion_medico != "" && $documentacion_institucion != "" && $cubierto == true && $entrega == true) {

                $fecha_fin = date('Y-m-d', strtotime("+" . $documentacion_reposo . " day", strtotime($documentacion_fecha_documento)));
                $period = new DatePeriod(
                    new DateTime($documentacion_fecha_documento),
                    new DateInterval('P1D'),
                    new DateTime($fecha_fin));

                foreach ($period as $key => $value) {
                    $array_cobertura[] = $value->format('Y-m-d');
                }
            }

            return $array_cobertura;
        }

    }

    /**
     * @param $documentacion_fecha_documento
     * @param $documentacion_reposo
     * @param $documentacion_tipo_id
     * @param $documentacion_fecha_incorporacion
     * @param $fecha_entrega
     * @param $documentacion_institucion
     * @param $documentacion_medico
     * @param $documentacion_diagnostico
     * @return array|string
     * @throws \Exception
     */
    public function comprobar_regularidad($documentacion_fecha_documento, $documentacion_reposo, $documentacion_tipo_id, $documentacion_fecha_incorporacion, $fecha_entrega, $documentacion_institucion, $documentacion_medico, $documentacion_diagnostico)
    {
        $fechas_feriado = Calendario::where('tipo', true)->get();
        $raya = [];
        $entrega = '';
        $alt = '';
        $fecha_cobertura = date('Y-m-d', strtotime("+" . $documentacion_reposo . " day", strtotime($documentacion_fecha_documento)));

        foreach ($fechas_feriado as $key => $fecha) {
            $raya[] = $fecha->fecha_feriado;
        }


        if ($documentacion_tipo_id == 1) {

            if ((new DateTime($fecha_cobertura) >= new DateTime($documentacion_fecha_incorporacion)) or ($documentacion_fecha_incorporacion == "")) {
                $cubierto = true;
            } else {
                $cubierto = false;
                $alt = $alt . 'Incorporacion posterior a fecha de cobertura certificado. ';

            }

            if (($fecha_entrega <= $documentacion_fecha_incorporacion) or ($documentacion_fecha_incorporacion == "")) {
                $entrega = true;
            } else {
                $entrega = false;
                $alt = $alt . "Fecha de entrega posterior a fecha de incorporacion.";
            }

            if ($documentacion_institucion == '') {
                $alt = $alt . "Certificado sin aval institucional. ";
            }

            if ($documentacion_medico == '') {
                $alt = $alt . "Certificado sin firma o sello de médico. ";
            }

            if ($documentacion_diagnostico == '') {
                $alt = $alt . "Certificado sin diagnostico. ";
            }
            $documentacion_notifico = true;
            $array_cobertura = array();
            $estado = array();
            if ($documentacion_notifico == true && $documentacion_diagnostico != "" && $documentacion_medico != "" && $documentacion_institucion != "" && $cubierto == true && $entrega == true) {
                $estado = $alt;
            } else {
                $estado = $alt;
            }

        }
        return $estado;

    }
}
