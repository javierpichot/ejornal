<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PrestacionPedido
 * @package App\Models
 */
class PrestacionPedido extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
    /**
     * @var array
     */
    protected $fillable = ['trabajador_id', 'empresa_id', 'prestacion_tipo_id', 'descripcion', 'observaciones', 'presupuesto', 'presupuesto_url', 'confirmacion', 'orden_servicio_url', 'reporte', 'reporte_url', 'feedback', 'estado', 'ausentismo_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trabajador()  : BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empresa()  : BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestacion_tipo()  : BelongsTo
    {
        return $this->belongsTo(PrestacionTipo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestacion_cotizacion() : HasMany
    {
        return $this->hasMany(PrestacionCotizacion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestacion_presupuesto() : HasMany
    {
        return $this->hasMany(PrestacionPresupuesto::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orden_servicio() : HasMany
    {
        return $this->hasMany(OrdenServicio::class);
    }

}
