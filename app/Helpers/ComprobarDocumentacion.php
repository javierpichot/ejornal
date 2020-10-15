<?php namespace App\Helpers;

use App\Models\Calendario;
use DateTime;
use DatePeriod;
use DateInterval;

/**
 *
 */
class ComprobarDocumentacion
{
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
