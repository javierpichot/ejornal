<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 06/11/18
 * Time: 12:21 AM
 */

namespace App\Helpers;


use Carbon\Carbon;

class ComprobarDiasAusente
{
    public function generateDates(string $since, string $until = null) {
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