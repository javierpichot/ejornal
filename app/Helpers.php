<?php
namespace App;

use Illuminate\Support\Facades\Artisan;

class Helpers
{

    public static function routeListName()
    {

        Artisan::call('route:list');
        $salida = Artisan::output();

        //Convertimos cada linea en un array
        $arrayList = explode(PHP_EOL, $salida);
        //Eliminamos las lineas del encabezado y pie del contenido
        $ultimaLinea    = count($arrayList) - 1;
        $penultimaLinea = count($arrayList) - 2;
        unset($arrayList[0], $arrayList[1], $arrayList[2], $arrayList["$ultimaLinea"], $arrayList["$penultimaLinea"]);

        foreach ($arrayList as $line) {
            $arrayLine = null;
            $long      = strlen($line) - 1;
            $cadena    = substr($line, 1, $long);
            $arrayLine = explode('|', $cadena);
            if (count($arrayLine) == 8) {
                $valor = trim($arrayLine['4']);
            } elseif (count($arrayLine) == 7) {
                $valor = trim($arrayLine['3']);
            }

            if ($valor && !strpos($valor, '\\')) {
                $temp[] = $valor;
            }

        }

        return $temp;
    }
}
?>