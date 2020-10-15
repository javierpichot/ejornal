<?php

namespace App\Models;

use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;


/**
 * Class Consulta
 * @package App\Models
 */
class Consulta extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;

    /**
     * @var array
     */
    protected $fillable = ['entrevista', 'examen_fisico', 'examenes_complementarios', 'diagnostico', 'tratamiento', 'enfermeria', 'fecha_consulta', 'observacion', 'trabajador_id', 'user_id', 'empresa_id', 'ausentismo_id', 'documentacion_id', 'consulta_reposo_id', 'consulta_motivo_id', 'consulta_tipo_id', 'nueva_cita', 'diagnostico_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function consulta_control() : HasOne
    {
        return $this->hasOne(ConsultaControl::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function consulta_prestacion_farmacia_droga() : BelongsToMany
    {
        return $this->belongsToMany(PrestacionFarmaciaDroga::class)->withPivot('cantidad');
    }

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
    public function documentacion() : BelongsTo
    {
        return $this->belongsTo(Documentacion::class);
    }

    public function consulta_diagnostico()
    {
        return $this->belongsTo(Diagnostico::class, 'diagnostico_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consulta_reposo() : BelongsTo
    {
        return $this->belongsTo(ConsultaReposo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consulta_motivo() : BelongsTo
    {
        return $this->belongsTo(ConsultaMotivo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consulta_tipo() : BelongsTo
    {
        return $this->belongsTo(ConsultaTipo::class);
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
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ausentismo() : BelongsTo
    {
        return $this->belongsTo(Ausentismo::class);
    }
}
