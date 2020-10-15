<?php

namespace App\Models;

use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;


/**
 * Class Comunicacion
 * @package App\Models
 */
class Comunicacion extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
    /**
     * @var array
     */
    protected $fillable = [
        'fecha',
        'remitente_id',
        'fecha_baja',
        'observacion',
        'contenido',
        'ausentismo_id',
        'comunicacion_tipo_id',
        'motivo_comunicacion_id',
        'modo_comunicacion_id',
        'documentacion_id',
        'empresa_id',
        'user_id',
        'trabajador_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trabajador() : BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }

    /**
     * @return BelongsTo
     */
    public function turno() : BelongsTo
    {
        return $this->belongsTo(Turno::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function remitente() : BelongsTo
    {
        return $this->belongsTo(Remitente::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modo_comunicacion() : BelongsTo
    {
        return $this->belongsTo(ModoComunicacion::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function motivo_comunicacion() : BelongsTo
    {
        return $this->belongsTo(MotivoComunicacion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function documentacion() : BelongsTo
    {
        return $this->belongsTo(Documentacion::class);
    }

    public function ausentismo()
    {
        return $this->belongsTo(Ausentismo::class);
    }
  
  
  
  
}
