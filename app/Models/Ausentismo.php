<?php

namespace App\Models;

use App\User;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Support\Carbon;

use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Ausentismo
 * @package App\Models
 */
class Ausentismo extends Model implements Auditable
{
    use  SoftDeletes, \OwenIt\Auditing\Auditable;

    /**
     * @var array
     */
    protected $fillable = ['fecha_ausente', 'fecha_alta', 'fecha_probable', 'empresa_id', 'trabajador_id', 'ausentismo_tipo_id', 'motivo', 'observacion', 'user_id', 'fecha_probable_alta', 'fecha_alta', 'fecha_ausente', 'incidencia_id', 'consulta_motivo_id'];

    /**
     * @var array
     */
    protected $appends = ['dias_ausente'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empresa() : BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

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
    public function ausentismo_tipo() : BelongsTo
    {
        return $this->belongsTo(AusentismoTipo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documentacion() : HasMany
    {
        return $this->hasMany(Documentacion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consulta() : HasMany
    {
        return $this->hasMany(Consulta::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comunicacion() : HasMany
    {
        return $this->hasMany(Comunicacion::class);
    }

    /**
     * @return int
     */
    public function getDiasAusenteAttribute()
    {
        $startTime = Carbon::parse($this->attributes['fecha_ausente']);
        $finishTime = Carbon::parse($this->attributes['fecha_alta']);
        //Si el campo fecha alta no esta vacio
        if (isset($finishTime)) {
            return $finishTime->diffInDays($startTime);
        } else {
            //Si el campo fecha alta lo esta contamos los
            //dias ausentes hasta la fecha actual
            $finishTime = Carbon::parse(Carbon::now()->format('Y-m-d'));
            return $finishTime->diffInDays($startTime);
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function incidencia() : BelongsTo
    {
        return $this->belongsTo(Incidencia::class);
    }

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeByAbiertos($query, $value)
    {
        return $query->whereNull('fecha_alta');
    }

    public function scopeByCerrados($query, $value)
    {
        return $query->whereNotNull('fecha_alta');
    }

    public function scopeByFechaInicio($query, $value)
    {
        return $query->whereDate('fecha_ausente', $value);
    }

    public function scopeByFechaFin($query, $value)
    {
        return $query->whereDate('fecha_ausente', $value);
    }

    public function scopeWhereDateBetween($query,$fromDate,$todate)
    {
        return $query->whereBetween('fecha_ausente', [$fromDate, $todate]);
    }
}
