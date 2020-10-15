<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;


/**
 * Class ConsultaControl
 * @package App\Models
 */
class ConsultaControl extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * @var array
     */
    protected $fillable = ['tension_arterial', 'peso', 'altura', 'glucemia', 'frecuencia_cardiaca', 'saturacion_oxigeno', 'trabajador_id', 'consulta_id'];

    /**
     * @var array
     */
    protected static $logAttributes = ['tension_arterial', 'peso', 'altura', 'glucemia', 'frecuencia_cardiaca', 'saturacion_oxigeno', 'trabajador_id', 'consulta_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trabajador() : BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consulta() : BelongsTo
    {
        return $this->belongsTo(Consulta::class);
    }
}
